<!DOCTYPE html>
<thead>
        <tr>
            <th><a class="btn-warning btn" type="button" onclick="changeorderby('id')"> ID </a></th>
            <th><a class="btn-warning btn" type="button" onclick="changeorderby('fname')"> İsim </a></th>
            <th><a class="btn-warning btn" type="button" onclick="changeorderby('lname')"> Soyisim </a></th>
            <th><a class="btn-warning btn" type="button" onclick="changeorderby('snumber')"> Okul No </a></th>
            <th><a class="btn-warning btn" type="button" onclick="changeorderby('department')"> Bölüm </a></th>
            <th><a class="btn-warning btn" type="button" onclick="changeorderby('age')"> Yaş </a></th>
            <th><button class="btn btn-info" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="true" aria-controls="multiCollapseExample2" id="buttonyenistudent">Yeni</button></th>
            <th><a href="studentlist" class="btn-primary btn" type="button"> Yenile </a></th>
            <input type="hidden" name="orderby" id="orderby" value="{{ request()->input('orderby', old('id')) }}">
            <input type="hidden" name="theascdesc" id="theascdesc" value="{{ request()->input('theascdesc',old('ASC')) }}">
        </tr>
        <tr>
            <th><input type="text" style="width: 75px;" name="likeid" id="likeid" value="{{ request()->input('likeid', old('')) }}"></th>
            <th><input type="text" name="likefname" id="likefname" value="{{ request()->input('likefname', old('')) }}"></th>
            <th><input type="text" name="likelname" id="likelname" value="{{ request()->input('likelname', old('')) }}"></th>
            <th><input type="text" style="width: 150px;" name="likesnumber" id="likesnumber" value="{{ request()->input('likesnumber', old('')) }}"></th>
            <th><input type="text" name="likedepartment" id="likedepartment" value="{{ request()->input('likedepartment', old('')) }}"></th>
            <th><input type="text" style="width: 75px;" name="likeage" id="likeage" value="{{ request()->input('likeage', old('')) }}"></th>
            <th><a type="submit" class="btn btn-success" id="filterbutton" onclick="fetch_datafilter()">Filtrele</a></th>
            <th></th>
        </tr>
</thead>

<tbody>
    @foreach ($students as $row)
    <tr id="{{ $row -> id}}trid">
        <td id="{{ $row -> id}}tdid" >{{ $row -> id}}</td>
        <td id="{{ $row -> id}}tdfname" >{{ $row -> fname}}</td>
        <td id="{{ $row -> id}}tdlname" >{{ $row -> lname}}</td>
        <td id="{{ $row -> id}}tdsnumber" >{{ $row -> snumber}}</td>
        <td id="{{ $row -> id}}tddepartment" >{{ $row -> department}}</td>
        <td id="{{ $row -> id}}tdage" >{{ $row -> age}}</td>
        <td><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample{{ $row->id }}" aria-expanded="true" 
        aria-controls="multiCollapseExample{{ $row->id }}" id="buttonduzenleogrenci{{ $row->id }}">Duzenle</button></td>
        <td><button class="btn btn-danger" type="button" onclick="studentsil('{{ $row->id }}')">Sil</button></td>
    </tr>
    <tr class="collapse multi-collapse" id="multiCollapseExample{{ $row->id }}">
        <form id="updatestudentajax" style="margin-left:auto;margin-right:auto; width: 50%;">
            @csrf
            <td> <input type="hidden" id="{{ $row->id }}studentid" name="id" value="{{ $row->id }}" style="width: 75px;"></td>
            <td> <input type="text" required="" class="form-control" id="{{ $row->id }}fname" name="fname" placeholder="adinizi giriniz" value="{{ $row->fname }}"></td>
            <td> <input type="text" required="" class="form-control" id="{{ $row->id }}lname" name="lname" placeholder="soyadinizi giriniz" value="{{ $row->lname }}"></td>
            <td> <input type="text" required="" class="form-control" id="{{ $row->id }}snumber" name="snumber" placeholder="ogrenci no giriniz" value="{{ $row->snumber }}"></td>
            <td> <input type="text" required="" class="form-control" id="{{ $row->id }}department" name="department" placeholder="bolumunuzu giriniz" value="{{ $row->department }}"></td>
            <td> <input type="text" required="" class="form-control" id="{{ $row->id }}age" name="age" placeholder="yasinizi giriniz" value="{{ $row->age }}" style="width: 75px;"></td>
            <td> <button class="btn btn-primary" type="submit" onclick="studentguncelle('{{ $row->id }}')">update student</button></td>
            <td></td>
        </form>
    </tr>
    @endforeach
    <tr>
    <td></td>
    <td></td>
    <td></td>
        <td> {!! $students->links() !!}</td>

    </tr>
</tbody>