<x-modal
    wire:model="openModal"
    title="Alterar avatar"
    class="backdrop-blur">
    <div
        x-data="{
            isDragActive: false,
            hasFile: false,
            previewUrl: '',
            fileName: '',
            fileSize: '',
            errorMessage: '',
            selectedFile: null,

            handleDrop(event) {
                this.isDragActive = false;

                // Segurança: event.dataTransfer pode ser undefined (p.ex. se chamado por click)
                const dt = event && (event.dataTransfer || event.clipboardData);
                if (!dt) return;

                const files = dt.files || [];

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
                    this.$nextTick(() => this.cropAvatar());
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

            position: {
                x: 0,
                y: 0
            },
            scale: 1,
            isDragging: false,
            startPoint: {
                x: 0,
                y: 0
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
                this.$nextTick(() => this.cropAvatar());
            },

            updatePreview() {
                this.$nextTick(() => this.cropAvatar());
            },

            init(){
                document.addEventListener('mousemove', (e) => this.drag(e));
                document.addEventListener('mouseup', () => this.endDrag());
                document.addEventListener('touchmove', (e) => this.drag(e));
                document.addEventListener('touchend', () => this.endDrag());
            },

            cropAvatar() {
                const img = this.$refs.image;
                const container = this.$refs.containerAvatar;

                // Criar canvas
                const canvas = this.$refs.previewAvatar;
                let context = canvas.getContext('2d');

                let imgPreview = new Image();
                imgPreview.onload = () => {
                    // Definir dimensões reais do canvas
                    canvas.width = container.clientWidth;
                    canvas.height = container.clientHeight;
                    canvas.style.width = container.clientWidth + 'px';
                    canvas.style.height = container.clientHeight + 'px';

                    // Calcular offset entre container e imagem na tela
                    const containerRect = container.getBoundingClientRect();
                    const imgRect = img.getBoundingClientRect();
                    const offsetX = containerRect.left - imgRect.left;
                    const offsetY = containerRect.top - imgRect.top;

                    // Converter para coordenadas da imagem natural
                    const scaleX = imgPreview.naturalWidth / imgRect.width;
                    const scaleY = imgPreview.naturalHeight / imgRect.height;

                    const sx = Math.max(0, offsetX * scaleX);
                    const sy = Math.max(0, offsetY * scaleY);
                    const sWidth = container.clientWidth * scaleX;
                    const sHeight = container.clientHeight * scaleY;

                    // Criar clipping path circular (mesmo tamanho do SVG: r=40%)
                    const centerX = canvas.width / 2;
                    const centerY = canvas.height / 2;
                    const radius = Math.min(canvas.width, canvas.height) * 0.4; // 40% como no SVG

                    context.save();
                    context.beginPath();
                    context.arc(centerX, centerY, radius, 0, Math.PI * 2);
                    context.clip();

                    context.drawImage(
                        imgPreview,
                        sx, sy, sWidth, sHeight,  // source
                        0, 0, canvas.width, canvas.height  // destination
                    );

                    context.restore();
                };
                imgPreview.src = this.previewUrl;
            },

            saveAvatar() {
                const canvas = this.$refs.previewAvatar;

                if (!canvas) {
                    this.errorMessage = 'Erro: Canvas não encontrado';
                    return;
                }

                canvas.toBlob((blob) => {
                    if (!blob) {
                        this.errorMessage = 'Erro ao processar imagem';
                        return;
                    }

                    const file = new File([blob], 'avatar.jpg', { type: 'image/jpeg' });

                    // Upload via Livewire
                    this.$wire.uploadMultiple('avatar', [file], () => {
                        // Após upload, chamar método para salvar
                        this.$wire.call('saveProcessedAvatar');
                    }, (error) => {
                        this.errorMessage = 'Erro no upload: ' + error;
                    });
                }, 'image/jpeg', 0.9);
            },
            log(){
                console.log($refs.containerAvatar.getBoundingClientRect());
            }
        }"
        x-init="log()"
        class="flex flex-col w-full space-y-4">

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
                    'border-base-content bg-neutral-content': isDragActive,
                    'border-solid border-primary': hasFile,
                    'border-gray-300 hover:border-gray-400': !isDragActive && !hasFile
                }"
                class="relative border-2 border-dashed rounded-lg p-2 cursor-pointer transition-all duration-200 ease-in-out">
                <input
                    type="file"
                    x-ref="fileInput"
                    @change="handleFileSelect($event)"
                    accept="image/*"
                    class="hidden">

                <!-- Ícone e texto quando não há arquivo -->
                <div x-show="!hasFile" class="text-center">
                    <x-icon name="o-cloud-arrow-up" class="w-18 h-18" />

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
                    <!-- Imagem completa com overlay escuro -->
                    <div class="relative w-full aspect-square overflow-hidden border-2 border-red-500" x-ref="containerAvatar">
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

                        <!-- Overlay com blur escuro apenas fora do círculo -->
                        <svg class="absolute inset-0 w-full h-full pointer-events-none" @click.stop="handleDrop($event)">
                            <defs>
                                <filter id="blur-filter">
                                    <feGaussianBlur stdDeviation="4" />
                                </filter>
                                <mask id="circle-mask">
                                    <rect width="100%" height="100%" fill="white" />
                                    <circle cx="50%" cy="50%" r="40%" fill="black" />
                                </mask>
                            </defs>
                            <rect width="100%" height="100%" fill="rgba(0, 0, 0, 0.7)" filter="url(#blur-filter)" mask="url(#circle-mask)" />

                            <!-- Borda circular -->
                            <circle cx="50%" cy="50%" r="40%" fill="none" stroke="currentColor" stroke-width="4" class="text-neutral-content" />
                        </svg>
                    </div>

                    <!-- Controles -->
                    <div>
                        <label>Zoom:</label>
                        <x-range
                            class="range-primary range-xs"
                            x-model="scale"
                            min="0.5"
                            max="3"
                            step="0.1"
                            @input="updatePreview()"
                            @click.stop="handleDrop($event)" />
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
        <div>
            <x-button
                @click.stop="removeFile()"
                type="button"
                label="Remover"
                icon="o-trash"
                class="btn btn-error"
                x-show="hasFile" />

            <x-button
                type="button"
                @click="$wire.openModal = false"
                class="btn btn-secondary"
                label="Cancelar" />

            <x-button
                type="button"
                x-bind:disabled="!hasFile"
                x-bind:class="{
                    'cursor-not-allowed': !hasFile
                }"
                class="btn"
                label="Confirmar"
                @click="saveAvatar()" />
        </div>

        {{-- Preview do Avatar --}}
        <canvas
            x-ref="previewAvatar"
        >

        </canvas>
    </div>
</x-modal>
