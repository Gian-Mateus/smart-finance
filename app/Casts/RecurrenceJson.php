<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class RecurrenceJson implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): ?array {
        if (is_null($value)) {
            return null;
        }

        return json_decode($value, true);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(
        Model $model,
        string $key,
        mixed $value,
        array $attributes,
    ): string {
        if (is_null($value)) {
            throw new InvalidArgumentException(
                "Configuração de recorrência não pode ser nula",
            );
        }

        if (!is_array($value)) {
            throw new InvalidArgumentException(
                "Configuração de recorrência deve ser um array",
            );
        }

        $this->validate($value);

        return json_encode($value);
    }

    private function validate(array $data): void
    {
        // Validar tipo obrigatório
        if (!isset($data["type"])) {
            throw new InvalidArgumentException('O campo "type" é obrigatório');
        }

        $validTypes = ["daily", "weekly", "monthly", "yearly", "custom"];
        if (!in_array($data["type"], $validTypes)) {
            throw new InvalidArgumentException(
                "Tipo inválido: {$data["type"]}. Tipos válidos: " .
                    implode(", ", $validTypes),
            );
        }

        // Validar intervalo para tipo custom
        if ($data["type"] === "custom" && empty($data["interval"])) {
            throw new InvalidArgumentException(
                "Tipo 'custom' requer um intervalo",
            );
        }

        // Validar dia do mês (1-31)
        if (
            isset($data["day_of_month"]) &&
            ($data["day_of_month"] < 1 || $data["day_of_month"] > 31)
        ) {
            throw new InvalidArgumentException(
                "Dia do mês deve estar entre 1 e 31",
            );
        }

        // Validar dia da semana
        if (isset($data["week_day"])) {
            $validWeekDays = [
                "domingo",
                "segunda",
                "terça",
                "quarta",
                "quinta",
                "sexta",
                "sabado",
            ];
            if (!in_array($data["week_day"], $validWeekDays)) {
                throw new InvalidArgumentException(
                    "Dia da semana inválido: {$data["week_day"]}",
                );
            }
        }

        // Validar monthly precisa de day_of_month
        if ($data["type"] === "monthly" && empty($data["day_of_month"])) {
            throw new InvalidArgumentException(
                "Tipo 'monthly' requer day_of_month",
            );
        }

        // Validar weekly precisa de week_day
        if ($data["type"] === "weekly" && empty($data["week_day"])) {
            throw new InvalidArgumentException("Tipo 'weekly' requer week_day");
        }

        // Validar datas
        if (
            isset($data["start_date"]) &&
            !$this->isValidDate($data["start_date"])
        ) {
            throw new InvalidArgumentException(
                "Data de início inválida: {$data["start_date"]}",
            );
        }

        if (
            isset($data["end_date"]) &&
            !$this->isValidDate($data["end_date"])
        ) {
            throw new InvalidArgumentException(
                "Data de fim inválida: {$data["end_date"]}",
            );
        }

        // Validar que end_date é posterior a start_date
        if (
            isset($data["start_date"]) &&
            isset($data["end_date"]) &&
            $data["start_date"] >= $data["end_date"]
        ) {
            throw new InvalidArgumentException(
                "Data de fim deve ser posterior à data de início",
            );
        }

        // Validar occurrences
        if (isset($data["occurrences"]) && $data["occurrences"] < 1) {
            throw new InvalidArgumentException(
                "Ocorrências deve ser maior que 0",
            );
        }
    }

    private function isValidDate(string $date): bool
    {
        $d = \DateTime::createFromFormat("Y-m-d", $date);
        return $d && $d->format("Y-m-d") === $date;
    }
}
