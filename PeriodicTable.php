<?php
class PeriodicTable {
    // 元素データ
    private $elements = [
        "H", "He", "Li", "Be", "B", "C", "N", "O", "F", "Ne", "Na", "Mg", "Al", "Si", "P", "S", "Cl", "Ar", "K", "Ca", "Sc",
        "Ti", "V", "Cr", "Mn", "Fe", "Co", "Ni", "Cu", "Zn", "Ga", "Ge", "As", "Se", "Br", "Kr", "Rb", "Sr", "Y", "Zr", "Nb",
        "Mo", "Tc", "Ru", "Rh", "Pd", "Ag", "Cd", "In", "Sn", "Sb", "Te", "I", "Xe", "Cs", "Ba", "La", "Ce", "Pr", "Nd", "Pm",
        "Sm", "Eu", "Gd", "Tb", "Dy", "Ho", "Er", "Tm", "Yb", "Lu", "Hf", "Ta", "W", "Re", "Os", "Ir", "Pt", "Au", "Hg", "Tl",
        "Pb", "Bi", "Po", "At", "Rn", "Fr", "Ra", "Ac", "Th", "Pa", "U", "Np", "Pu", "Am", "Cm", "Bk", "Cf", "Es", "Fm", "Md",
        "No", "Lr", "Rf", "Db", "Sg", "Bh", "Hs", "Mt", "Ds", "Rg", "Cn", "Nh", "Fl", "Mc", "Lv", "Ts", "Og"
    ];

    /**
     * 元素データの整形
     * @return array data 整形後元素データ
     */
    public function shapingElements(): array {
        $data = [];
        // 特定の元素の前に空白を挿入
        $data["table1"] = $this->addSpacesElements($this->elements);
        // 特定の元素を削除
        $this->removeElements($data["table1"], "La", "Lu");
        $this->removeElements($data["table1"], "Ac", "Lr");
        // La系・Ac系のテーブル作成
        $data["table2"][] = $this->extractElements($this->elements, "La", "Lu");
        $data["table2"][] = $this->extractElements($this->elements, "Ac", "Lr");
        return $data;
    }

    /**
     * 特定の元素の前に空白を追加した配列を作成
     * @param array data 空白追加前の元素データ
     * @return array elms 空白を追加した元素データ
     */
    private function addSpacesElements(array $data): array {
        $elms = [];
        foreach($data as $val) {
            if (in_array($val, ['He', 'B', 'Al', 'Hf', 'Rf'])) {
                $spaces = 0;
                switch($val) {
                    case 'He':
                        $spaces = 16;
                        break;
                    case 'B':
                    case 'Al':
                        $spaces = 10;
                        break;
                    case 'Hf':
                    case 'Rf':
                        $spaces = 1;
                        break;
                }
                $elms = array_pad($elms, count($elms) + $spaces, ' ');
            }
            $elms[] = $val;
        }
        return $elms;
    }

    /**
     * 元素データの要素削除
     * @param array &data 元素データ（※参照渡し）
     * @param string start 削除する最初の元素記号
     * @param string end 削除する最後の元素記号
     * @return void
     */
    private function removeElements(array &$data, string $start, string $end): void {
        $startIndex = $this->getElmIndex($start, $data);
        $endIndex = $this->getElmIndex($end, $data);
        if ($startIndex === false || $endIndex === false || $startIndex > $endIndex) {
            throw new Exception("Error: removeElements function");
        }
        array_splice($data, $startIndex, $endIndex - $startIndex + 1);
    }

    /**
     * 元素データの一部を取得
     * @param array data 元素データ
     * @param string start 取得する最初の元素記号
     * @param string end 取得する最後の元素記号
     * @return array 元素データの一部
     */
    private function extractElements(array $data, string $start, string $end): array {
        $elms = [];
        $startIndex = $this->getElmIndex($start, $data);
        $endIndex = $this->getElmIndex($end, $data);
        if ($startIndex === false || $endIndex === false || $startIndex > $endIndex) {
            return $elms;
        }
        $elms = array_slice($data, $startIndex, $endIndex - $startIndex + 1);
        return $elms;
    }

    /**
     * 元素データのインデックスを取得
     * @param string search_elm インデックスを取得する要素の値
     * @param array data 探索先データ
     * @return int 元素データのインデックス
     */
    private function getElmIndex(string $search_elm, array $data): int {
        return array_search($search_elm, $data);
    }
}