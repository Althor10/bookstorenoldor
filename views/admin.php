<div class="main">
    <div class="shop_top">
        <div class="container">
            <div class="row shop_box-top">
                <?php if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->type === 'admin'): ?>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#users">Users</a></li>
                    <li><a data-toggle="tab" href="#books">Books</a></li>
                    <li><a data-toggle="tab" href="#sliders">Sliders</a></li>
                    <li><a data-toggle="tab" href="#messages">Messages</a></li>
                </ul>

                <div class="tab-content">
                    <div id="users" class="tab-pane fade in active">
                        <h3>Users</h3>
                        <p>Managing users.</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Day Of Registration</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Type</th>
                                <th scope="col">Adress</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $upitcinaZaBazu = "SELECT *,b.id as bid FROM bookaneers b INNER JOIN bookaneerroles br ON b.role_id = br.id WHERE br.type!='admin'";
                            $aloo = executeQuery($upitcinaZaBazu);

                            foreach ($aloo as $user):
                                ?>
                                <tr>
                                    <th scope="row"><?= $user->bid ?></th>
                                    <td><?= $user->first_name ?></td>
                                    <td><?= $user->last_name ?></td>
                                    <td><?= $user->bookaneer_name ?></td>
                                    <td><?= $user->private_mail ?></td>
                                    <td><?= $user->day_of_reg ?></td>
                                    <td><?= $user->activity ?></td>
                                    <td><?= $user->type ?></td>
                                    <td><?= $user->adress ?></td>
                                    <td><a href="index.php?page=edit&id=<?= $user->bid ?>">Edit</a></td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-user"
                                                data-id="<?= $user->bid ?>">Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="books" class="tab-pane fade">
                        <h3>Books</h3>
                        <p>Books manage</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Price</th>
                                <th scope="col">Picture Path</th>
                                <th scope="col">Sale</th>
                                <th scope="col">New</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $upitBooks = "SELECT *,b.id as bid, p.id as pid FROM book b INNER JOIN pictures p ON b.picture_id =p.id INNER JOIN author a ON b.author_id = a.id ORDER BY b.id";
                            $getBooks = executeQuery($upitBooks);

                            foreach ($getBooks as $book):
                                ?>
                                <tr>
                                    <th scope="row"><?= $book->bid ?></th>
                                    <td><?= $book->title ?></td>
                                    <td><?= $book->author_firstname." ".$book->author_lastname ?></td>
                                    <td>$<?= $book->price ?></td>
                                    <td><?= $book->path ?></td>
                                    <td><?= $book->sale ?></td>
                                    <td><?= $book->new ?></td>
                                    <td><a href="index.php?page=bookedit&id=<?= $book->bid ?>">Edit</a></td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-book"
                                                data-id="<?= $book->bid ?>">Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="index.php?page=insertbook"><input type="button" class="btn btn-danger" value="INSERT"> </a>
                    </div>
                    <div id="sliders" class="tab-pane fade">
                        <h3>Sliders</h3>
                        <p>Editing and Deleting Sliders</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Text</th>
                                <th scope="col">Picture path</th>
                                <th scope="col">A href path</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $querySlider = "SELECT *,s.id as sid, ps.id as psid FROM slider s INNER JOIN pictures_slide ps ON s.picture_id = ps.id";
                            $getSlider = executeQuery($querySlider);

                            foreach ($getSlider as $slider):
                                ?>
                                <tr>
                                    <th scope="row"><?= $slider->sid ?></th>
                                    <td><?= $slider->text ?></td>
                                    <td>$<?= $slider->path ?></td>
                                    <td><?= $slider->a_path ?></td>
                                    <td><a href="index.php?page=slideedit&id=<?= $slider->sid ?>">Edit</a></td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-slider"
                                                data-id="<?= $slider->sid ?>">Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="index.php?page=newslide"><input type="button" class="btn btn-danger"  value="INSERT"/></a>
                    </div>
                    <div id="messages" class="tab-pane fade">
                        <h3>Messages</h3>
                        <p>Sent Messages from users and buyers</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Who</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Text</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $queryContact = "SELECT *,c.id as cid FROM contact c";
                            $getContacts = executeQuery($queryContact);

                            foreach ($getContacts as $contact):
                                ?>
                                <tr>
                                    <th scope="row"><?= $contact->cid ?></th>
                                    <td><?= $contact->name ?></td>
                                    <td>$<?= $contact->email ?></td>
                                    <td><?= $contact->subject ?></td>
                                    <td><?= $contact->text ?></td>
                                    <td><a href="index.php?page=response&id=<?= $contact->cid ?>">Respond</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.delete-user').click(function () {
            var id = $(this).data('id');
            // alert(id);

            $.ajax({
                method: 'POST',
                url: "php/ajax_delete_user.php",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function (podaci) {
                    alert("User is deleted.");
                    location.reload();
                },
                error: function (xhr, statusTxt, error) {
                    var status = xhr.status;
                    switch (status) {
                        case 500:
                            alert("Server ERROR! Curently it is not possible to delete the user.");
                            break;
                        case 404:
                            alert("Page not Found!");
                            break;
                        default:
                            alert("Error: " + status + " - " + statusTxt);
                            break;
                    }
                }
            });
        });
    });
</script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.delete-book').click(function () {
                    var id = $(this).data('id');
                    // alert(id);

                    $.ajax({
                        method: 'POST',
                        url: "php/ajax_delete_book.php",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function (podaci) {
                            alert("The book has been removed!");
                            location.reload();
                        },
                        error: function (xhr, statusTxt, error) {
                            var status = xhr.status;
                            switch (status) {
                                case 500:
                                    alert("Server ERROR! Curently it is not possible to delete the user.");
                                    break;
                                case 404:
                                    alert("Page not Found!");
                                    break;
                                default:
                                    alert("Error: " + status + " - " + statusTxt);

                                    break;
                            }
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.delete-slider').click(function () {
                    var id = $(this).data('id');
                    // alert(id);

                    $.ajax({
                        method: 'POST',
                        url: "php/ajax_delete_slide.php",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function (podaci) {
                            alert("The slide has been removed!");
                            location.reload();
                        },
                        error: function (xhr, statusTxt, error) {
                            var status = xhr.status;
                            switch (status) {
                                case 500:
                                    alert("Server ERROR! Curently it is not possible to delete the slide.");
                                    break;
                                case 404:
                                    alert("Page not Found!");
                                    break;
                                default:
                                    alert("Error: " + status + " - " + statusTxt);
                                    location.reload();
                                    break;
                            }
                        }
                    });
                });
            });
        </script>
<?php else: ?>
    <h4> YOU CANT ENTER THIS PAGE </h4>
    <script> alert("DONT DO THIS MATE!");</script>
<?php endif; ?>

