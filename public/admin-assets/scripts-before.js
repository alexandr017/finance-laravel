 $(document).ready(function(){

	$("#rowtbl").DataTable({
        "sort": true,
        "pageLength": 50,
        "language": {"url": "/backend/dataTables/datatables.json"}
    });
    
});
