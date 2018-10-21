<?php

if (isset($_REQUEST["panierClear"])) {
    Panier::clear();
}

if (isset($_REQUEST["panierValidate"])) {
    Panier::validate();
}

echo Panier::toString();
echo Panier::toClear();
echo Panier::toValidate();