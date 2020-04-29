<?php
    include_once( dirname(__FILE__) . '/../db-connect.php');
    function getMessages() {
        $connection = openDatabaseConnection();
        $stmt = $connection->prepare("SELECT * FROM contact_us;");
        $stmt->execute();
        $messages = $stmt->fetchAll();
        $i = 0;
        foreach($messages as $message) {
            $collapse_id = "collapse" . $i;
            $heading_id = "heading" . $i;
            $button_on_click = "deleteMessage(" . $message['id'] . ");";
            $mailto = "mailto:" . $message['email'] . "?Subject=B%26D%20Deli%20Inquiry";
            echo <<<EOT
            <div class="card">
            <div class="card-header" id="$heading_id">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#$collapse_id" aria-expanded="false" aria-controls="$collapse_id">
                  {$message['subject']} - {$message['name']}
                </button>
              </h5>
            </div>
        
            <div id="$collapse_id" class="collapse" aria-labelledby="$heading_id" data-parent="#contact_us_group">
              <div class="card-body">
                <div class="container>
                    <div class="row">
                    {$message['message']}
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <a href="$mailto" target="_top" class="btn btn-primary">Send Email</a>
                        </div>
                        <div class="col-sm-">
                            <button class="btn btn-danger" onclick="$button_on_click">Delete Message</button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
EOT;
            $i++;
        }
    }
    
    if($_POST['method'] == "DELETE" && isset($_POST['msgid'])) {
        $connection = openDatabaseConnection();
        $stmt = $connection->prepare("DELETE FROM contact_us WHERE id = ?;");
        $stmt->execute([$_POST['msgid']]);
    }
?>