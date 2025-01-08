<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<?php

include 'font.php';

function success($msg, $url)
{
    echo "
    <script>
    $(document).ready(function() {
    Swal.fire({
        title: 'สำเร็จ',
        text: '$msg',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        type: 'success'
    }).then(function() {
        window.location = '$url';
    });
})
</script>
    ";
}



function failed($msg, $url)
{
    echo "
    <script>
    $(document).ready(function() {
    Swal.fire({
        title: 'ไม่สำเร็จ',
        text: '$msg',
        icon: 'error',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        type: 'error'
    }).then(function() {
        window.location = '$url';
    });
})
</script>
    ";
}

function confirm($msg)
{
    
    echo "
    <script>

    $(document).ready(function() {
        
        Swal.fire({
            title: 'คุณแน่ใจใช่หรือไม่?',
            text: '$msg',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3b3c3d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                    window.location.href = '';
                }else {
                    
                }
                    
        });
    })
    </script>
    ";
}

?>


