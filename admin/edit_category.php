<?php
<label><input type='checkbox' name='categories[]' value='<?php echo $result['id']; ?>'
                <?php  if ($cat['category_id'] === $result['id']) { echo 'checked'; }  ?> /> <?php echo $result['name']; ?></label>