@if(Session::has('success'))
<div class="fixed flex justify-center top-0 right-0 left-0" id="message">
    <p class="text-xl font-bold bg-blue-600 text-white m-1 px-5 py-2 rounded-b-lg">{{session('success')}}</p>
</div>
<script>
    setTimeout(()=>{
        document.getElementById('message').style.display='none';

    },2000);
</script>
@endif