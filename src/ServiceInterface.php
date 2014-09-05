<?php

namespace StephenHill;

interface ServiceInterface
{
	public function encode($string);
	public function decode($base58);
}