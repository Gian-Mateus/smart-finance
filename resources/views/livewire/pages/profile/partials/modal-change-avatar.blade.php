<x-modal
    wire:model="openModal"
    title="Alterar avatar"
    class="backdrop-blur"
>
    <div
        x-data="avatarUpload()"
        class="flex flex-col w-full space-y-4"
    >
        <!-- Área de Upload -->
        <div class="space-y-2">
            <label class="block font-bold text-md">
                Escolha uma imagem:
            </label>

            <div
                @dragover.prevent="isDragActive = true"
                @dragleave.prevent="isDragActive = false"
                @drop.prevent="handleDrop($event)"
                @click="$refs.fileInput.click()"
                :class="{
                    'border-blue-500 bg-blue-50': isDragActive,
                    'border-solid border-primary': hasFile,
                    'border-gray-300 hover:border-gray-400': !isDragActive && !hasFile
                }"
                class="relative border-2 border-dashed rounded-lg p-8 cursor-pointer transition-all duration-200 ease-in-out"
            >
                <input
                    type="file"
                    x-ref="fileInput"
                    @change="handleFileSelect($event)"
                    accept="image/*"
                    class="hidden"
                >

                <!-- Ícone e texto quando não há arquivo -->
                <div x-show="!hasFile" class="text-center">
                    <x-icon name="o-cloud-arrow-up" class="w-18 h-18"/>

                    <div class="space-y-2">
                        <p class="text-lg font-medium">
                            <span x-show="isDragActive">Solte a imagem aqui</span>
                            <span x-show="!isDragActive">Clique para selecionar</span>
                        </p>
                        <p class="text-sm text-gray-500">
                            ou arraste e solte uma imagem
                        </p>
                        <p class="text-xs text-gray-400">
                            PNG, JPG até 5MB
                        </p>
                    </div>
                </div>

                <!-- Preview da imagem selecionada -->
                <div x-show="hasFile" class="text-center" @click.stop="handleDrop($event)">
                    <div class="overflow-hidden relative rounded-[50%] size-42 object-cover mx-auto">
                           <div class="relative rounded-[50%] w-full h-full">
                               <img
                                   :src="previewUrl"
                                   x-ref="image"
                                   @mousedown="startDrag($event)"
                                   @touchstart="startDrag($event)"
                                   :style="`transform: translate(${position.x}px, ${position.y}px) scale(${scale})`"
                                   class="active:cursor-grabbing absolute cursor-grab object-cover select-none w-full"
                                   alt="Avatar"
                                   @click.stop="handleDrop($event)"
                               >
                            </div>

                           <!-- Overlay circular -->
                           <div class="absolute -top-3 -left-3 -right-3 -bottom-3 rounded-[50%] pointer-events-none blur-sm bg-gray-500/10" @click.stop="handleDrop($event)"></div>
                       </div>

                       <!-- Controles -->
                       <div>
                            <label>Zoom:</label>
                            <x-range
                                x-model="scale"
                                min="0.5"
                                max="3"
                                step="0.1"
                                @input="updatePreview()"
                                @click.stop="handleDrop($event)"
                            />
                       </div>
                    <div class="space-y-1">
                        <p class="text-sm font-mediu" x-text="fileName"></p>
                        <p class="text-xs text-gray-500" x-text="fileSize"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensagem de erro -->
        <div x-show="errorMessage">
            <x-alert class="alert-error" icon="o-exclamation-triangle">
                    <p x-text="errorMessage"></p>
            </x-alert>
        </div>

        <!-- Botões de ação -->
        <div class="flex justify-end space-x-3 pt-4">
            <x-button
                @click.stop="removeFile()"
                type="button"
                label="Remover"
                icon="o-trash"
                class="btn btn-error"
                x-show="hasFile"
            />

            <x-button
                type="button"
                @click="$wire.openModal = false"
                class="btn btn-secondary"
                label="Cancelar"
            />

            <x-button
                type="button"
                x-bind:disabled="!hasFile"
                x-bind:class="{
                    'cursor-not-allowed': !hasFile
                }"
                class="btn"
                label="Confirmar"
                @click="cropAvatar()"
            />
        </div>
    </div>
</x-modal>

<script>
function avatarUpload() {
    return {
        isDragActive: false,
        hasFile: false,
        previewUrl: '',
        fileName: '',
        fileSize: '',
        errorMessage: '',
        selectedFile: null,

        handleDrop(event) {
            this.isDragActive = false;
            const files = event.dataTransfer.files;

            if (files.length > 0) {
                this.processFile(files[0]);
            }
        },

        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.processFile(file);
            }
        },

        processFile(file) {
            // Limpar erro anterior
            this.errorMessage = '';

            // Validar tipo de arquivo
            if (!file.type.startsWith('image/')) {
                this.errorMessage = 'Por favor, selecione apenas arquivos de imagem.';
                return;
            }

            // Validar tamanho (5MB = 5 * 1024 * 1024 bytes)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                this.errorMessage = 'A imagem deve ter no máximo 5MB.';
                return;
            }

            // Processar arquivo válido
            this.selectedFile = file;
            this.fileName = file.name;
            this.fileSize = this.formatFileSize(file.size);

            // Criar preview
            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewUrl = e.target.result;
                this.hasFile = true;
            };
            reader.readAsDataURL(file);
        },

        removeFile() {
            this.hasFile = false;
            this.previewUrl = '';
            this.fileName = '';
            this.fileSize = '';
            this.selectedFile = null;
            this.errorMessage = '';
            this.$refs.fileInput.value = '';
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },

        position: { x: 0, y: 0 },
        scale: 1,
        isDragging: false,
        startPoint: { x: 0, y: 0 },

        init() {
            // Eventos globais para drag
            document.addEventListener('mousemove', (e) => this.drag(e));
            document.addEventListener('mouseup', () => this.endDrag());
            document.addEventListener('touchmove', (e) => this.drag(e));
            document.addEventListener('touchend', () => this.endDrag());
        },

        startDrag(e) {
            this.isDragging = true;
            const clientX = e.clientX || e.touches[0].clientX;
            const clientY = e.clientY || e.touches[0].clientY;

            this.startPoint = {
                x: clientX - this.position.x,
                y: clientY - this.position.y
            };

            e.preventDefault();
        },

        drag(e) {
            if (!this.isDragging) return;

            const clientX = e.clientX || e.touches[0].clientX;
            const clientY = e.clientY || e.touches[0].clientY;

            this.position.x = clientX - this.startPoint.x;
            this.position.y = clientY - this.startPoint.y;

            // Limitar movimento para manter imagem visível
            const maxOffset = 100;
            this.position.x = Math.max(Math.min(this.position.x, maxOffset), -maxOffset);
            this.position.y = Math.max(Math.min(this.position.y, maxOffset), -maxOffset);

            e.preventDefault();
        },

        endDrag() {
            this.isDragging = false;
        },

        updatePreview() {
            // Atualização automática via Alpine.js binding
        },

        cropAvatar() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const size = 200; // Tamanho do avatar final

            canvas.width = size;
            canvas.height = size;

            const img = new Image();
            img.onload = () => {
                // Criar círculo de clipping
                ctx.beginPath();
                ctx.arc(size/2, size/2, size/2, 0, 2 * Math.PI);
                ctx.clip();

                // Desenhar imagem com transformações aplicadas
                ctx.drawImage(
                    img,
                    this.position.x,
                    this.position.y,
                    img.width * this.scale,
                    img.height * this.scale
                );

                // Obter dados da imagem cropada
                const croppedDataUrl = canvas.toDataURL('image/jpeg', 0.9);

                // Aqui você pode enviar para o servidor ou usar como quiser
                console.log('Avatar cropado:', croppedDataUrl);

                // Exemplo: mostrar resultado
                this.showResult(croppedDataUrl);
            };
            img.src = this.imageUrl;
        },

        showResult(dataUrl) {
            // Criar preview do resultado
            const result = document.createElement('img');
            result.src = dataUrl;
            result.style.width = '100px';
            result.style.height = '100px';
            result.style.borderRadius = '50%';
            result.style.margin = '10px';
            result.style.border = '2px solid #10b981';

            document.body.appendChild(result);
        }
    }
}
</script>
