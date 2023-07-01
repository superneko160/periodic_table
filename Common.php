<?php
// 共通関数クラス
class Common {
    /**
     * JSONファイルを読み込み、配列にして返す
     * @param string filename 読み込むファイル名
     * @return array data 元素データ
     */
    public static function readJSONFileToArray(string $filename): array {
        $jsonString = file_get_contents($filename);
        if ($jsonString === false) {
            throw new Exception("Failed to read JSON file: $filename");
        }
        $data = json_decode($jsonString, true);
        if ($data === null) {
            throw new Exception("Failed to decode JSON file: $filename");
        }
        return $data;
    }
}