@extends('layouts/app')

@section('content')
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Department</th>
                <th scope="col">Base salary</th>
                <th scope="col">Salary perk</th>
                <th scope="col">Perk type</th>
                <th scope="col">Total salary</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>{{ $employee->getBaseSalary()->getFormatted() }}</td>
                    <td>{{ $employee->getLastSalary() ? $employee->getLastSalary()->getPerk()->getFormatted() : 'NOT GENERATED' }}</td>
                    <td>{{ $employee->department->perk_type }}</td>
                    <td>{{ $employee->getLastSalary() ? $employee->getLastSalary()->getMonthlySalary()->getFormatted() : 'NOT GENERATED' }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
