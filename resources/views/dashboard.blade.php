@extends('layouts.app')
@section('content')


        <h1 class="text-black font-bold text-3xl pt-3 dark:text-white"><i class="ri-dashboard-fill pr-2 text-2xl"></i>Dashboard</h1>
        <div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>

   <div class="grid grid-cols-3 mt-5 gap-8">
    <div class="bg-gray-600 shadow rounded-lg p-5">
    <div class="bg-gray-300 shadow rounded-lg p-5">
        
<h1 class="text-2xl font-bold  text-shadow "><i class="ri-user-star-fill p-4 text-2xl"></i></i>Specialities</h1>   
<p class="font-bold p-3 gap-x-10">Total Specialities: {{$specialists}}</p>     
    </div>
    </div>
    <div class="bg-gray-600 shadow rounded-lg p-5">
    <div class="bg-gray-300 shadow rounded-lg p-5">


<h1 class="text-2xl font-bold  text-shadow "><i class="ri-psychotherapy-fill p-3 text-2xl"></i>Therapist</h1>   
<p class="font-bold p-3 gap-x-10">Total Therapists: {{$therapists}}</p>     
    </div>
    </div>
    <div class="bg-gray-600 shadow rounded-lg p-5">
    <div class="bg-gray-300 shadow rounded-lg p-5">

<h1 class="text-2xl font-bold  text-shadow "><i class="ri-timer-2-fill gap-2 p-3 text-2xl"></i></i>Pending Appointments</h1>   
<p class="font-bold p-3 gap-x-10">Total Pending Appointments: {{$pending}}</p>     
    </div>
    </div>
    <div class="bg-gray-600 shadow rounded-lg p-5">
    <div class="bg-gray-300 shadow rounded-lg p-5">

<h1 class="text-2xl font-bold  text-shadow "><i class="ri-check-double-line p-3 text-2xl"></i>Approve Appointments</h1>   
<p class="font-bold p-3 gap-x-10">Total Approve Appointments: {{$approved}}</p>     
    </div>
    </div>
    <div class="bg-gray-600 shadow rounded-lg p-5">
    <div class="bg-gray-300 shadow rounded-lg p-5">
<h1 class="text-2xl font-bold  text-shadow "><i class="ri-calendar-line text-2xl p-3"></i>Rejected Appointments</h1>   
<p class="font-bold p-3 gap-x-10">Total Rejected Appointments:{{$rejected}}</p>     
    </div>
    </div>
    <div class="bg-gray-600 shadow rounded-lg p-5">
    <div class="bg-gray-300 shadow rounded-lg p-5">
<h1 class="text-2xl font-bold  text-shadow "><i class="ri-empathize-fill p-4 text-2xl"> </i>Mindfulness Activities</h1> 
<p class="font-bold p-3 gap-x-10">Total Mindfulness Activities: {{$mindfulness}}</p>     
</div>
</div>
<div>
<div class="flex justify-center"> <!-- Flex container to center the canvas -->
    <canvas id="myChart" style="width: 80%; max-width: 600px;"></canvas> <!-- Set max width for responsiveness -->

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = {
        labels: ["Pending", "Approved", "Declined"], // Pie chart labels
        datasets: [{
            label: "Appointments", // Dataset label
            data: [{{$pending}}, {{$approved}}, {{$rejected}}], // Data for the chart
            backgroundColor: [
    "rgb(33, 53, 85)", // Soft lavender for "Pending"
    "rgb(62, 88, 121)",  // Teal green for "Approved"
    "rgb(216, 196, 182)"  // Muted coral for "Declined"
],


            hoverOffset: 10 // Hover effect size
        }],
    };

    const configPie = {
        type: "pie", // Specify chart type as pie
        data: data,
        options: {
            responsive: true, // Enable responsiveness
            plugins: {
                legend: {
                    display: true, // Show legend
                    position: "top", // Position legend at the top
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let dataset = tooltipItem.dataset.data;
                            let total = dataset.reduce((acc, val) => acc + val, 0); // Calculate total value
                            let value = dataset[tooltipItem.dataIndex];
                            let percentage = ((value / total) * 100).toFixed(2); // Calculate percentage
                            return `${tooltipItem.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    };

    var pieChart = new Chart(
        document.getElementById("myChart"), // Target the canvas element with ID "myChart"
        configPie // Apply the configuration
    );
</script>

</div>
   </div>
   </div>
@endsection
