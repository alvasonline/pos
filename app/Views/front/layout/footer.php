
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; AlvasOnline <?php echo date('Y'); ?></div>
            <div>
                <i class="fa-brands fa-facebook"></i> <a style="color:#666; text-decoration:none" href="#"> Facebook</a>
                &middot;
                <i class="fa-brands fa-instagram-square"></i> <a style="color:#666; text-decoration:none" href="#"> Instagram</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://startbootstrap.github.io/startbootstrap-sb-admin/js/scripts.js"></script>

<!-- DataTable -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="https://startbootstrap.github.io/startbootstrap-sb-admin/js/datatables-simple-demo.js"></script>



<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
  $('#modal-confirma').on('show.bs.modal', function(e) {
           $(this).find(' .btn-ok').attr('href', $(e.relatedTarget).data('href'));
        })
    }) 
</script>
</body>

</html>