<?php

namespace App\Service;

class Slugify
{
    public function generate(string $input): string
    {
        $SpecialChars = ['é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê', 'á', 'à',
                        'ä', 'â', 'å', 'Á', 'À', 'Ä', 'Â', 'Å', 'ó', 'ò',
                        'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô', 'í', 'ì', 'ï', 'î',
                        'Í', 'Ì', 'Ï', 'Î', 'ú', 'ù', 'ü', 'û', 'Ú', 'Ù',
                        'Ü', 'Û', 'ý', 'ÿ', 'Ý', 'ø', 'Ø', 'œ', 'Œ', 'Æ',
                        'ç', 'Ç', ' ', '!', '?', ',', '.', ':', ';', '--','---'];
        $classicChars = ['e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'a', 'a', 'a', 'a', 'a',
                        'A', 'A', 'A', 'A', 'A', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O',
                        'i', 'i', 'i', 'I', 'I', 'I', 'I', 'I', 'u', 'u', 'u', 'u', 'U',
                        'U', 'U', 'U', 'y', 'y', 'Y', 'o', 'O', 'a', 'A', 'A', 'c', 'C', '-', '', '', '', '', '', '', '-', '-'];
        $replaceSpecialchars = str_replace($SpecialChars, $classicChars, $input);
        $cleanInput = strtolower(trim($replaceSpecialchars));
        return $cleanInput;
    }
}