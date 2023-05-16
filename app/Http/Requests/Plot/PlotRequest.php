<?php

namespace App\Http\Requests\Plot;

class PlotRequest extends CommonPlotRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            self::CADASTRAL_NUMBERS_NAME => 'required|array'
        ];
    }

    /**
     * Преобразовываем строку в массив
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if ($this->has(self::CADASTRAL_NUMBERS_NAME)) {
            $this->{self::CADASTRAL_NUMBERS_NAME} = explode(',', $this->{self::CADASTRAL_NUMBERS_NAME});
            $this->offsetSet(self::CADASTRAL_NUMBERS_NAME, $this->{self::CADASTRAL_NUMBERS_NAME}); // изменяем значение свойства объекта
        }
    }
}
