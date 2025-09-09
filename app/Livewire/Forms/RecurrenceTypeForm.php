<?php

namespace App\Livewire\Forms;

use App\Models\RecurrenceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RecurrenceTypeForm extends Form
{
    // Propriedade para armazenar o ID do registro durante edição/exclusão
    public ?int $id = null;

    // Propriedades do formulário
    #[Validate('required', message: 'O nome é obrigatório.')]
    #[Validate('string', message: 'Valor inválido.')]
    #[Validate('max:50', message: 'Máximo 50 caracteres.')]
    public $name;

    #[Validate('required', message: 'Selecione o tipo de repetição.')]
    #[Validate('in:monthly,weekly,interval,yearly')]
    public $type;

    public $day_of_month;
    public $week_day;
    public $interval;
    public $start_date;
    public $end_date;
    public $occurrences;

    // Propriedade auxiliar para controlar a condição de término
    #[Validate('required', message: 'Selecione uma condição de término.')]
    #[Validate('in:never,on_date,after_occurrences')]
    public $end_condition = 'never';


    /**
     * Regras de validação dinâmicas.
     */
    public function rules(): array
    {
        return [
            'day_of_month' => [
                // Obrigatório se o tipo for 'monthly' ou 'yearly'
                Rule::requiredIf(in_array($this->type, ['monthly', 'yearly'])),
                'integer',
                'min:1',
                'max:31'
            ],
            'week_day' => [
                // Obrigatório se o tipo for 'weekly'
                Rule::requiredIf($this->type === 'weekly'),
                Rule::in(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])
            ],
            'interval' => [
                // Obrigatório se o tipo for 'interval' ou 'yearly'
                Rule::requiredIf(in_array($this->type, ['interval', 'yearly'])),
                'integer',
                'min:1'
            ],
            'start_date' => [
                'required',
                'date'
            ],
            'end_date' => [
                // Obrigatório se a condição de término for 'on_date'
                Rule::requiredIf($this->end_condition === 'on_date'),
                'date',
                'after_or_equal:start_date' // Deve ser depois da data de início
            ],
            'occurrences' => [
                // Obrigatório se a condição de término for 'after_occurrences'
                Rule::requiredIf($this->end_condition === 'after_occurrences'),
                'integer',
                'min:1'
            ]
        ];
    }

    /**
     * Limpa os dados não utilizados antes de salvar no banco.
     */
    private function cleanupUnusedData(): void
    {
        // Zera campos de limite de acordo com a condição de término
        if ($this->end_condition !== 'on_date') {
            $this->end_date = null;
        }
        if ($this->end_condition !== 'after_occurrences') {
            $this->occurrences = null;
        }

        // Zera campos de tipo de repetição que não foram escolhidos
        if (!in_array($this->type, ['monthly', 'yearly'])) {
            $this->day_of_month = null;
        }
        if ($this->type !== 'weekly') {
            $this->week_day = null;
        }
        if (!in_array($this->type, ['interval', 'yearly'])) {
            $this->interval = null;
        }
    }

    /**
     * Cria uma nova recorrência.
     */
    public function store(): void
    {
        // Valida os dados e limpa os campos não utilizados
        $this->validate();
        $this->cleanupUnusedData();

        // Cria o registro no banco de dados
        RecurrenceType::create([
            ...$this->only(['name', 'type', 'day_of_month', 'week_day', 'interval', 'start_date', 'end_date', 'occurrences']),
            'user_id' => Auth::id()
        ]);

        $this->reset();
    }

    /**
     * Atualiza uma recorrência existente.
     */
    public function update(): void
    {
        // Garante que temos um ID para atualizar
        if (!$this->id) {
            return;
        }
        
        // Valida os dados e limpa os campos não utilizados
        $this->validate();
        $this->cleanupUnusedData();

        // Encontra e atualiza o registro
        $recurrence = RecurrenceType::where('id', $this->id)->where('user_id', Auth::id())->firstOrFail();
        $recurrence->update(
            $this->only(['name', 'type', 'day_of_month', 'week_day', 'interval', 'start_date', 'end_date', 'occurrences'])
        );

        $this->reset();
    }

    /**
     * Deleta uma recorrência.
     */
    public function delete(): void
    {
        // Garante que temos um ID para deletar
        if (!$this->id) {
            return;
        }
        
        // Encontra e deleta o registro
        RecurrenceType::where('id', $this->id)->where('user_id', Auth::id())->delete();
        $this->reset();
    }
}
