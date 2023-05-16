@extends('layouts.master')
@section('content')
    <div class="container">
        <h1>Получение кадастровых данных</h1>

        <form class="ajax" method="get" action="{{route('plots.get_name')}}">
            <div class="form-group">
                <label class="h6">Кадастровые номера</label>
                <input type="text"
                       class="form-control"
                       id="cadastral_numbers"
                       value="69:27:0000022:1306,69:27:0000022:1307"
                       name="cadastral_numbers"
                       placeholder="69:27:0000022:1306,69:27:0000022:1307">
                <div class="invalid-feedback"></div>
                <small id="emailHelp" class="form-text text-muted">Введите кадастровые номера через запятую.</small>
            </div>
            <button type="submit" class="btn btn-primary">Получить данные</button>
        </form>

        <div class="mt-3">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Кадастровый номер</th>
                    <th scope="col">Адрес</th>
                    <th scope="col">Стоимость</th>
                    <th scope="col">Площадь</th>
                </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
        </div>
    </div>

@endsection
