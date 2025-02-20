<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
</head>
<body>
    <h2>Add New Product</h2>
    <table>
        <form action="product_save.php" method="post">
                <tr>
                    <td>Barcode</td>
                    <td>
                        <input type="text" name="barcode">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <input type="text" name="desc">
                    </td>
                </tr>
                <tr>
                    <td>Unit Price</td>
                    <td>
                        <input type="text" name="uprice">
                    </td>
                </tr>
                <tr>
                    <td>Stocks</td>
                    <td>
                        <input type="text" name="stocks">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="" value="Save"></td>
                </tr>


        </form>
    </table>
</body>
</html>