<?php
require_once __DIR__.'/../../config/init.php';
$action = Input('action');
$table = 'product';

if($action == 'list') {

    $draw = $_POST['draw'];
    $start = $_POST['start'];
    $length = $_POST['length'];
    $searchValue = $_POST['search']['value'];

    $orderColumnIndex = $_POST['order'][0]['column'];
    $orderDirection = $_POST['order'][0]['dir'];


    if(Input('filterdata') == 'Draft') {
        $sql = "SELECT * FROM $table WHERE status = :stat";
    } else if(Input('filterdata') == 'Actived') {
        $sql = "SELECT * FROM $table WHERE status = :act";

    } else {
        $sql = "SELECT * FROM $table WHERE 1=1";
    }


    if (!empty($searchValue)) {
        $sql .= " AND (name LIKE :searchValue)";
    }



    $columns = array('id', 'name', 'status', 'created_at');
    $orderColumn = $columns[$orderColumnIndex] ?? $columns[0];

    $orderDirection = isset($orderDirection) ? $orderDirection : 'desc';

    $sql .= " ORDER BY $orderColumn $orderDirection";

    $sql .= " LIMIT :length OFFSET :start";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':length', (int)$length, PDO::PARAM_INT);

    if(Input('filterdata') == 'Draft') {
        $stmt->bindValue(':stat', 0, PDO::PARAM_INT);
    } else if(Input('filterdata') == 'Actived') {
        $stmt->bindValue("act", 1, PDO::PARAM_INT);
    }

    if (!empty($searchValue)) {
        $stmt->bindValue(':searchValue', "%$searchValue%", PDO::PARAM_STR);
    }


    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalRecords = $pdo->query("SELECT COUNT(*) FROM $table ")->fetchColumn();

    $totalFiltered = (!empty($searchValue)) ? count($results) : $totalRecords;

    $columnTitles = 0;

    $data = array();
    foreach ($results as $row) {
        $id = $row['id'];

        $status = $row['status'] === 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Drafted</span>';
        $dropDown = '<div class="btn-group dropdown-split-info">
         <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="mdi mdi-menu me-1"></i>
      </button>
      <div class="dropdown-menu">';

        if ($row['status'] != 1) {
            $dropDown .= '
        <li><a  class="dropdown-item waves-effect waves-light activate" data-id="' . $row['id'] . '" href="#">Activate</a></li>
        <li>';
        } else {
            $dropDown .= '
        <li><a class="dropdown-item waves-effect waves-light text-warning draft" href="#" data-id="'.$id.'">Draft</a></li>
        <li>';
        }

        $dropDown .= '<a data-id="' . $row['id'] . '" class="dropdown-item waves-effect waves-light text-info edit" href="#" data-toggle="modal" data-target="#editModal">Edit</a></li>
    <li>';
        $dropDown .= '<a data-id="' . $row['id'] . '" class="dropdown-item waves-effect waves-light text-danger delete " href="#">Delete</a>
    </li>
                         
        </ul>
    </div>';

        $image = $row['image'] ? APP_URL.'/thumb/'.$row['image'] : APP_URL.'/assets/images/light-box/single-small.jpg';

        $rowData = [
            $row['id'], '<img class="border border-dark" src="'.$image.'" alt="Icon" width="60" height="60">', $row['name'], $row['code'], $row['cost_price'], $row['sell_price'], $row['stock'], $row['tax'], $row['discount'], $status, $dropDown, date('D m, Y', strtotime($row['created_at']))
        ];

        $rowData = array_combine(range(0, count($rowData) - 1), array_values($rowData));

        $data[] = $rowData;
    }

    $response = array(
        "draw" => (int)$draw,
        "recordsTotal" => (int)$totalRecords,
        "recordsFiltered" => (int)$totalFiltered,
        "columns" => $columnTitles,
        "data" => $data
    );

    echo json_encode($response);

}
else if($action == 'add') {
    header("Content-Type: application/json");
    $s = 0;
    $m = "";

    if(empty(Input('name')) || empty(Input('code')) ||  empty(Input('cost_price')) || empty(Input('sale_price')) || empty(Input('stock'))) {
        $m = "Some field need to be filled";
    } else {

        if($_FILES['image']['name']) {
            $image = $_FILES['image'];
            $size = $image['size'];
            $tmp = $image['tmp_name'];
            $name = $image['name'];

            if(checkSize($size)) {
                $m = "Image size must not be greater than 5 MB";
            } else if(checkType($name)) {
                $m = "Invalid image Format";
            } else {
                $folder = $root.'/thumb/';
                $file = $folder.$name;

                while(file_exists($file)) {
                    $file = removeExtension($name).rand(1,9);
                }

                if(move_uploaded_file($tmp, $file)) {
                    $data = [
                        'name' => Input('name'),
                        'code' => Input('code'),
                        'image' => $name,
                        'cat_id' => Input('category'),
                        'cost_price' => Input('cost_price'),
                        'sell_price' => Input('sale_price'),
                        'stock' => Input('stock'),
                        'description' => Input('desc'),
                        'tax' => Input('tax'),
                        'discount' => Input('discount'),
                        'status' => Input('status') ? 1 : 0,
                    ];

                    if($db->Insert($table, $data)) {
                        $s = 1;
                        $m = "$table Added Successfully";
                    } else {
                        $m = $db->getLastErrno();
                    }
                } else {
                    $m = "Image Upload failed";
                }
            }


        } else {
            $data = [
                'name' => Input('name'),
                'code' => Input('code'),
                'cat_id' => Input('category'),
                'cost_price' => Input('cost_price'),
                'sell_price' => Input('sale_price'),
                'stock' => Input('stock'),
                'description' => Input('desc'),
                'tax' => Input('tax'),
                'discount' => Input('discount'),
                'status' => Input('status') ? 1 : 0,
            ];

            if($db->Insert($table, $data)) {
                $s = 1;
                $m = "$table Added Successfully";
            } else {
                $m = $db->getLastErrno();
            }
        }


    }

    echo json_encode(['m' => $m, 's' => $s]);

}
else if($action == 'edit') {
    header("Content-Type: application/json");
    $s = 0;
    $m = "";
    $id = Input('id');

    if(empty(Input('name')) || empty(Input('code')) ||  empty(Input('cost_price')) || empty(Input('sale_price')) || empty(Input('stock'))) {
        $m = "Some field need to be filled";
    } else if(empty(Input('cat_id'))) {
        $m = "category field cannot be empty";
    } else {

        if($_FILES['image']['name']) {

            $image = $_FILES['image'];
            $size = $image['size'];
            $tmp = $image['tmp_name'];
            $name = $image['name'];

            if(checkSize($size)) {
                $m = "Image size must not be greater than 5 MB";
            } else if(checkType($name)) {
                $m = "Invalid image Format";
            } else {
                $folder = __DIR__.'/../../thumb/';
                $file = $folder.$name;

                while(file_exists($file)) {
                    $file = removeExtension($name).rand(1,9);
                }

                if(move_uploaded_file($tmp, $file)) {
                    $data = [
                        'name' => Input('name'),
                        'code' => Input('code'),
                        'image' => $name,
                        'cat_id' => Input('cat_id'),
                        'cost_price' => Input('cost_price'),
                        'sell_price' => Input('sale_price'),
                        'stock' => Input('stock'),
                        'description' => Input('desc'),
                        'tax' => Input('tax'),
                        'discount' => Input('discount'),
                        'status' => Input('status') ? 1 : 0,
                    ];



                    if($db->where('id', $id)->update($table, $data)) {
                        $s = 1;
                        $m = "$table Updated Successfully";
                    } else {
                        $m = $db->getLastErrno();
                    }
                } else {
                    $m = "Image Upload failed";
                }
            }


        }
        else {
            $data = [
                'name' => Input('name'),
                'code' => Input('code'),
                'cat_id' => Input('cat_id'),
                'cost_price' => Input('cost_price'),
                'sell_price' => Input('sale_price'),
                'stock' => Input('stock'),
                'description' => Input('desc'),
                'tax' => Input('tax'),
                'discount' => Input('discount'),
                'status' => Input('status') ? 1 : 0,
            ];

            if($db->where('id', $id)->update($table, $data)) {
                $s = 1;
                $m = "$table updated Successfully";
            } else {
                $m = $db->getLastError();
            }
        }


    }

    echo json_encode(['m' => $m, 's' => $s]);

}
else if($action == 'settingStatus') {
    header("Content-Type: application/json");
    $type = Input('type');
    $ids = InputArray('ids');
    $errorMessages = [];
    $s = 0;
    $m = "";

    if(!$ids) {
        $s = 0;
        $m = "No Item selected";
    } else if(!in_array($type, ['activateAll', 'draftAll', 'draft', 'activate', 'delete', 'deleteAll'])) {
        $s = 0;
        $m = "Invalid action";
    } else {
        $total = 0;
        switch ($type) {
            case 'activateAll':
                foreach ($ids as $id) {
                    if(!$id) {
                        continue;
                    }
                    if($db->where('id', $id)->update($table, ['status' => 1])) {
                        $total++;
                    } else {
                        $errorMessages[] = "Error activating row with ID $id: " . $db->getLastError();
                    }

                }

                if($total > 0) {
                    $s = 1;
                    $m = "$total $table where successfully Activated";
                } else {
                    $s = 0;
                    $m = "Error : ". implode(',',$errorMessages);
                }
                break;

            case 'draftAll':
                foreach ($ids as $id) {
                    if(!$id) {
                        continue;
                    }
                    if($db->where('id', $id)->update($table, ['status' => 0])) {
                        $total++;
                    } else {
                        $errorMessages[] = "Error activating row with ID $id: " . $db->getLastError();
                    }

                }

                if($total > 0) {
                    $s = 1;
                    $m = "$total $table where successfully Drafted";
                } else {
                    $s = 0;
                    $m = "Error : ". implode(',',$errorMessages);
                }
                break;
            case "deleteAll":
                foreach($ids as $id) {
                    if (!$id) {
                        continue;
                    }
                    if ($db->where('id', $id)->delete($table)) {
                        $total++;
                    } else {
                        $errorMessages[] = "Error Deleting row with ID $id: " . $db->getLastError();
                    }
                }

                if($total > 0) {
                    $s = 1;
                    $m = "$total $table where successfully Deleted";
                } else {
                    $s = 0;
                    $m = "Error : ". implode(',',$errorMessages);
                }
                break;
            case 'draft':

                if($db->where('id', $ids)->update($table, ['status' => 0])) {
                    $s = 1;
                    $m = "item where successfully drafted";
                } else {
                    $s = 0;
                    $m = "Error : ". $db->getLastError();
                }
                break;
            case 'activate':

                if($db->where('id', $ids)->update($table, ['status' => 1])) {
                    $s = 1;
                    $m = "item where successfully Updated";
                } else {
                    $s = 0;
                    $m = "Error : ". $db->getLastError();
                }
                break;
            case 'delete':
                if($db->where('id', $ids)->delete($table)) {
                    $s = 1;
                    $m = "item where successfully Deleted";
                } else {
                    $s = 0;
                    $m = "Error : ". $db->getLastError();
                }

            default:
                $s = 0;
                $m = "Undefined Action";
        }


    }
    echo json_encode(['m' => $m, 's' => $s]);
}
else if($action == 'getRow') {
    $id = Input('id');
    $row = $db->where('id', $id)->getOne($table);
    echo json_encode($row);
}
else if($action == 'generate-code') {
    $code = rand(100000, 999999);
    $product = $db->where('code', $code)->getOne($table);

    while ($product) {
        $code = rand(100000, 999999);
        $product = $db->where('code', $code)->getOne($table);
    }

    echo json_encode($code);

}
else if($action == 'category') {

    $results = $db->get('category');

    $data = [];

    if(!empty(Input('id'))) {
        $cats = $db->where('id', Input('id'))->getOne('category');
        if ($results !== false) {
            if($cats) {
                $data[] = '<option value="' . $cats['id'] . '">' . $cats['name'] . '</option>';

            } else {
                $data[] =  "Error ".$db->getLastError();
            }
            foreach ($results as $row) {
                $data[] = '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
        } else {
            echo "Error in database query.";
        }
    } else {
        if ($results !== false) {
            foreach ($results as $row) {
                $data[] = '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
        } else {
            echo "Error in database query.";
        }
    }


    echo implode('', $data);
}
else {
    header("Content-Type: application/json");
    echo json_encode(['m' => 'No Action', 's' => 0]);
}