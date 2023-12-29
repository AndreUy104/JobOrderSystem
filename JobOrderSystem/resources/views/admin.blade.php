@extends('mainView.layout')
@section('content')
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <button class="nav-link active" onclick="setActive(1)">User List</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" onclick="setActive(2)">Report</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div id="report" style="display: none">
            <x-charts :monthlySales="$monthSales" :monthTotalSales="$monthTotalSales"></x-charts>
        </div>
        <div id="list" style="display: block">
            <x-userList :users="$users"></x-userList>

        </div>
    </div>
</div>
@endsection

<script>
    function setActive(index) {
        // Remove 'active' class from all links
        var links = document.getElementsByClassName("nav-link");
        for (var i = 0; i < links.length; i++) {
            links[i].classList.remove("active");
        }

        // Use switch to determine which link to make active
        switch (index) {
            case 1:
                links[5].className = "nav-link active";
                document.getElementById('report').style.display = 'none';
                document.getElementById('list').style.display = 'block';
                break;
            case 2:
                links[6].className = "nav-link active";
                document.getElementById('report').style.display = 'block';
                document.getElementById('list').style.display = 'none';
                break;
            // Add more cases as needed

            default:
                // Handle unexpected index
                break;
        }
    }
</script>
