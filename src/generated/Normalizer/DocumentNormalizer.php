<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace MonsieurBiz\SyliusSearchPlugin\generated\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DocumentNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'MonsieurBiz\\SyliusSearchPlugin\\generated\\Model\\Document';
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \MonsieurBiz\SyliusSearchPlugin\generated\Model\Document;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            return null;
        }
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['document-origin']);
        }
        if (isset($data->{'$recursiveRef'})) {
            return new Reference($data->{'$recursiveRef'}, $context['document-origin']);
        }
        $object = new \MonsieurBiz\SyliusSearchPlugin\generated\Model\Document();
        if (property_exists($data, 'type') && $data->{'type'} !== null) {
            $object->setType($data->{'type'});
        }
        if (property_exists($data, 'code') && $data->{'code'} !== null) {
            $object->setCode($data->{'code'});
        }
        if (property_exists($data, 'id') && $data->{'id'} !== null) {
            $object->setId($data->{'id'});
        }
        if (property_exists($data, 'enabled') && $data->{'enabled'} !== null) {
            $object->setEnabled($data->{'enabled'});
        }
        if (property_exists($data, 'slug') && $data->{'slug'} !== null) {
            $object->setSlug($data->{'slug'});
        }
        if (property_exists($data, 'image') && $data->{'image'} !== null) {
            $object->setImage($data->{'image'});
        }
        if (property_exists($data, 'channel') && $data->{'channel'} !== null) {
            $values = [];
            foreach ($data->{'channel'} as $value) {
                $values[] = $value;
            }
            $object->setChannel($values);
        }
        if (property_exists($data, 'attributes') && $data->{'attributes'} !== null) {
            $values_1 = [];
            foreach ($data->{'attributes'} as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, 'MonsieurBiz\\SyliusSearchPlugin\\generated\\Model\\Attributes', 'json', $context);
            }
            $object->setAttributes($values_1);
        }
        if (property_exists($data, 'price') && $data->{'price'} !== null) {
            $values_2 = [];
            foreach ($data->{'price'} as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, 'MonsieurBiz\\SyliusSearchPlugin\\generated\\Model\\Price', 'json', $context);
            }
            $object->setPrice($values_2);
        }
        if (property_exists($data, 'original_price') && $data->{'original_price'} !== null) {
            $values_3 = [];
            foreach ($data->{'original_price'} as $value_3) {
                $values_3[] = $this->denormalizer->denormalize($value_3, 'MonsieurBiz\\SyliusSearchPlugin\\generated\\Model\\Price', 'json', $context);
            }
            $object->setOriginalPrice($values_3);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getType()) {
            $data->{'type'} = $object->getType();
        }
        if (null !== $object->getCode()) {
            $data->{'code'} = $object->getCode();
        }
        if (null !== $object->getId()) {
            $data->{'id'} = $object->getId();
        }
        if (null !== $object->getEnabled()) {
            $data->{'enabled'} = $object->getEnabled();
        }
        if (null !== $object->getSlug()) {
            $data->{'slug'} = $object->getSlug();
        }
        if (null !== $object->getImage()) {
            $data->{'image'} = $object->getImage();
        }
        if (null !== $object->getChannel()) {
            $values = [];
            foreach ($object->getChannel() as $value) {
                $values[] = $value;
            }
            $data->{'channel'} = $values;
        }
        if (null !== $object->getAttributes()) {
            $values_1 = [];
            foreach ($object->getAttributes() as $value_1) {
                $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
            }
            $data->{'attributes'} = $values_1;
        }
        if (null !== $object->getPrice()) {
            $values_2 = [];
            foreach ($object->getPrice() as $value_2) {
                $values_2[] = $this->normalizer->normalize($value_2, 'json', $context);
            }
            $data->{'price'} = $values_2;
        }
        if (null !== $object->getOriginalPrice()) {
            $values_3 = [];
            foreach ($object->getOriginalPrice() as $value_3) {
                $values_3[] = $this->normalizer->normalize($value_3, 'json', $context);
            }
            $data->{'original_price'} = $values_3;
        }

        return $data;
    }
}
