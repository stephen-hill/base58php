<?php

include("base58.php");

echo "http://flic.kr/p/" . base58::encode(3392387861) . "\n";

// outputs: http://flic.kr/p/6aLSHT

echo "3392387861 = " . base58::decode(base58::encode(3392387861)) . "\n";

// outputs: 3392387861 = 3392387861
