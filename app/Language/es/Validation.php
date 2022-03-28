<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Validation language settings
return [
    // Core Messages
    'noRuleSets'      => 'No se han establecido reglas en la configuración de validación.',
    'ruleNotFound'    => '{0} no es una regla de validación válida.',
    'groupNotFound'   => '{0} no es un grupo de reglas de validación.',
    'groupNotArray'   => '{0} el grupo de validación debe ser un array.',
    'invalidTemplate' => '{0} no es un modelo de validación válido.',

    // Rule Messages
    'alpha'                 => 'El campo solo puede contener caracteres alfabéticos.',
    'alpha_dash'            => 'El campo solo puede contener caracteres alfanuméricos, subrayados, y guiones.',
    'alpha_numeric'         => 'El campo solo puede contener caracteres alfanuméricos.',
    'alpha_numeric_punct'   => 'El campo solo puede contener caracteres alfanuméricos, espacios, y los caracteres ~ ! # $ % & * - _ + = | : . .',
    'alpha_numeric_space'   => 'El campo solo puede contener caracteres alfanuméricos y espacios.',
    'alpha_space'           => 'El campo solo puede contener caracteres alfabéticos y espacios.',
    'decimal'               => 'El campo debe contener un número decimal.',
    'differs'               => 'El campo debe diferir del campo {param}.',
    'equals'                => 'El campo debe ser exactamente: {param}.',
    'exact_length'          => 'El campo debe tener exactamente {param} caractéres de longitud.',
    'greater_than'          => 'El campo debe contener un número mayor que {param}.',
    'greater_than_equal_to' => 'El campo debe contener un número mayor o igual a {param}.',
    'hex'                   => 'El campo solo puede contener caracteres hexadecimales.',
    'in_list'               => 'El campo debe ser uno de: {param}.',
    'integer'               => 'El campo debe contener un entero.',
    'is_natural'            => 'El campo debe contener solo dígitos.',
    'is_natural_no_zero'    => 'El campo debe solo contener dígitos y ser mayor que cero.',
    'is_not_unique'         => 'El campo debe contener un valor previamente existente en la base de datos.',
    'is_unique'             => 'El campo ya existe.',
    'less_than'             => 'El campo debe contener un número menor que {param}.',
    'less_than_equal_to'    => 'El campo debe contener un número menor o igual a {param}.',
    'matches'               => 'El campo no coincide con el campo {param}.',
    'max_length'            => 'El campo no pude exceder los {param} caracteres de longitud.',
    'min_length'            => 'El campo debe tener al menos {param} caracteres de longitud.',
    'not_equals'            => 'El campo no puede ser: {param}.',
    'not_in_list'           => 'El campo no debe ser uno de: {param}.',
    'numeric'               => 'El campo debe contener solo números.',
    'regex_match'           => 'El campo no está en el formato correcto.',
    'required'              => 'El campo es obligatorio.',
    'required_with'         => 'El campo es obligatorio cuando {param} está presente.',
    'required_without'      => 'El campo es obligatorio cuando {param} no está presente.',
    'string'                => 'El campo debe ser una cadena válida.',
    'timezone'              => 'El campo debe ser una zona horaria válida.',
    'valid_base64'          => 'El campo debe ser una cadena base64 válida.',
    'valid_email'           => 'El campo debe contener una dirección de email válida.',
    'valid_emails'          => 'El campo debe contener todas las direcciones de email válidas.',
    'valid_ip'              => 'El campo debe contener una IP válida.',
    'valid_url'             => 'El campo debe contener una URL válida.',
    'valid_date'            => 'El campo debe contener una fecha válida.',

    // Credit Cards
    'valid_cc_num' => 'no parece ser un número de tarjeta de crédito válida.',

    // Files
    'uploaded' => 'no es un campo de subida de archivo válido.',
    'max_size' => 'es demasiado grande para un archivo.',
    'is_image' => 'no es válido, subido archivo de imagen.',
    'mime_in'  => 'no tiene un tipo válido de mime.',
    'ext_in'   => 'no tiene una extensión de archivo válida.',
    'max_dims' => 'no es una imagen o tiene demasiado alto o ancho.',
];
