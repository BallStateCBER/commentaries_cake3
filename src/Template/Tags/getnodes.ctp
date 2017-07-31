<?php
    $data = [];
    foreach ($nodes as $node) {
        $text = ucwords($node->name).' ('.$node->id.')';
        $datum = [
            "text" => $text,
            "id" => $node->id,
            "cls" => "folder",
            "leaf" => ($node->lft + 1 == $node->rght)
        ];
        /* The 'Delete' group needs to be available to drag tags into,
         * but if it's emptied, it becomes a leaf. Here, that's prevented. */
        if (strtolower($node->name) == 'delete') {
            $datum['leaf'] = false;
        }
        if (isset($_GET['no_leaves'])) {
            $datum['leaf'] = false;
        }
        $data[] = $datum;
    }
    echo $this->Js->object($data);
