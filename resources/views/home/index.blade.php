@extends('layouts/app')

@section('content')
    <div class="container-fluid">
        <div class="p-3">
            <form action="/" method="GET">
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="{{ $filters['first_name'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="{{ $filters['last_name'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="department">Department</label>
                    <select class="form-control" name="department_id" id="department_id">
                        <option value="">...</option>
                        @foreach($departments as $department)
                            <option
                            value="{{ $department->id }}"
                            {{ isset($filters['department_id']) && $filters['department_id'] == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sort">Order by</label>
                    <select class="form-control" name="sort" id="sort">
                        <option value="">...</option>
                        @foreach ($sortTypes as $type => $description)
                            <option
                                value="{{ $type }}"
                                {{ isset($filters['sort']) && $filters['sort'] == $type ? 'selected' : '' }}
                                >
                                {{ $description }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Set</button>
            </form>
        </div>
    </div>

    <div class="container-fluid">
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
    </div>
@endsection
