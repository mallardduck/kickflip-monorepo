<?php

namespace KickflipMonoTests;

use SebastianBergmann\Exporter\Exporter;

trait DataProviderHelpers
{
    /**
     * @psalm-template  T
     * @param array $array<array-key, array<array-key T>>
     *
     * @return array<string, array<array-key T>>
     */
    public function autoAddDataProviderKeys(array $array)
    {
        $exporter = new Exporter();
        $normalizedKeys = [];
        foreach ($array as $key => $data) {
            if (is_int($key)) {
                $normalizedKeys[] = \sprintf('(%s)', $exporter->shortenedRecursiveExport($data));
            } else {
                $normalizedKeys[] = \sprintf('data set "%s"', $key);
            }
        }

        if (!is_array(array_values($array)[0])) {
            return array_combine($normalizedKeys, array_map(fn($value) => [$value], $array));
        }
        return array_combine($normalizedKeys, $array);
    }
}
