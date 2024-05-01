<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DOM Manipulation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   
  </head>
  <body class="bg-dark">
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-10 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Add Items</h4>
                    </div>
                    <div id="alert"></div>
                    <div class="card-body p-4">
                        <form action="#" method="POST" id="add_form">
                            @csrf
                            <div class="show_item">

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <input type="text" name="product_name[]" class="form-control" placeholder="Item Name">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <input type="number" name="product_price[]" class="form-control" placeholder="Item Price">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <input type="number" name="product_qty[]" class="form-control" placeholder="Item Quantity">
                                    </div>

                                    <div class="col-md-2 mb-3 d-grid">
                                        <button class="btn btn-success add_item_btn">Add More</button>
                                    </div>
                                </div>
                                
                            </div>
                            <div>
                                <input type="submit" value="Add Product" class="btn btn-primary w-25" id="add_btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="show_item_add" style="visibility: hidden">

        <div class="row appended">
            <div class="col-md-3 mb-3">
                <input type="text" name="product_name[]" class="form-control" placeholder="Item Name">
            </div>

            <div class="col-md-3 mb-3">
                <input type="number" name="product_price[]" class="form-control" placeholder="Item Price">
            </div>

            <div class="col-md-3 mb-3">
                <input type="number" name="product_qty[]" class="form-control" placeholder="Item Quantity">
            </div>

            <div class="col-md-2 mb-3 d-grid">
                <button class="btn btn-danger remove_item_btn">Remove</button>
            </div>
        </div>
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            let add_product = $('#show_item_add').html();
            $('.add_item_btn').click(function (e){
                e.preventDefault();
                $('.show_item').append(add_product);
            });

            $(document).on('click', '.remove_item_btn', function(e){
                e.preventDefault();
                let element = $(this).parent().parent();
                $(element).remove();
            });

            // ajax request to send all data to the database
            $('#add_form').submit(function(e){
                e.preventDefault();
                $('#add_btn').val('Adding...');
                $.ajax({
                    url: "{{ route('product.store') }}",
                    method: "POST",
                    datatype: 'json',
                    data: $(this).serialize(),
                    success: function(response){
                       $('#add_btn').val('Add Product');
                       $('#add_form')[0].reset();
                       $('.appended').remove();
                       $('#alert').html('<div class="alert alert-success" role="alert">'+response.message+'</div>');
                    }
                });
            });
           
        });
    </script>
  </body>
</html>