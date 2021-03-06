<?php

namespace Jane\OpenApi2\Tests\Expected\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class PetNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Jane\\OpenApi2\\Tests\\Expected\\Model\\Pet';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Jane\\OpenApi2\\Tests\\Expected\\Model\\Pet';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (array_key_exists('petType', $data) and 'Cat' === $data['petType']) {
            return $this->denormalizer->denormalize($data, 'Jane\\OpenApi2\\Tests\\Expected\\Model\\Cat', $format, $context);
        }
        if (array_key_exists('petType', $data) and 'Dog' === $data['petType']) {
            return $this->denormalizer->denormalize($data, 'Jane\\OpenApi2\\Tests\\Expected\\Model\\Dog', $format, $context);
        }
        $object = new \Jane\OpenApi2\Tests\Expected\Model\Pet();
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (\array_key_exists('petType', $data)) {
            $object->setPetType($data['petType']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getPetType() and 'Cat' === $object->getPetType()) {
            return $this->normalizer->normalize($object, $format, $context);
        }
        if (null !== $object->getPetType() and 'Dog' === $object->getPetType()) {
            return $this->normalizer->normalize($object, $format, $context);
        }
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getPetType()) {
            $data['petType'] = $object->getPetType();
        }
        return $data;
    }
}