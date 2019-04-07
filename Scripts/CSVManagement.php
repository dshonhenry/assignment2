<!--CSVMANAGEMENT.PHP-->

<?php
class CSV_Manager {
    public static function addRecord($filePath, $record) {
        $file = fopen($filePath, "a");
        fputcsv($file, $record);
        fclose($file);
    }

    public static function removeRecordById($filePath, $id, $idIndex) {
        $file = file($filePath);
        $records = [];

        foreach ($file as $line) {
            if($id == str_getcsv($line)[$idIndex]) 
                continue;
            $records[] = str_getcsv($line);
        }
        fclose($file);
        $file = fopen($filePath, "w");
        foreach($records as $record)
            fputcsv($file, $record);
    }

    public static function updateRecord($filePath, $record, $idIndex) {
        $file = file($filePath);
        $records = [];

        foreach ($file as $line) {
            $newRecord = str_getcsv($line);
            
            if($record[$idIndex] == str_getcsv($line)[$idIndex])
                $newRecord = $record;           
            $records[] = $newRecord;
        }
        fclose($file);

        $file = fopen($filePath, "w");
        foreach($records as $rec)
            fputcsv($file, $rec);
        fclose($file);
    }

    public static function getRecordById($filePath, $id, $idIndex)
    {
        $file = file($filePath);

        foreach ($file as $line) {
            if($id== str_getcsv($line)[$idIndex]) 
                return $line;
        }
        fclose($file);
        return null;
    }
}
?>