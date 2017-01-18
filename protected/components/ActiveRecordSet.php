<?php
class ActiveRecordSet implements IteratorAggregate, ArrayAccess {

	protected $_objects;
	protected $_attributes;

	public function __construct(array $objects) {
		$this->_objects = $objects;
	}

	public function __call($method, $args) {
		if (preg_match('~existsBy([a-z])+~i', $method, $field_raw)) {
			return $this->existsBy($field_raw[1], $args[0]);
		}
	}

	public function existsBy($field, $value) {
		$this->ensureFieldExists($field);
		foreach ($this->_objects as $object) {
			if ($object->$field == $value)
				return true;
		}
		return false;
	}

	public function getBy($field, $value) {
		$this->ensureFieldExists($field);
		foreach ($this->_objects as $object) {
			if ($object->$field == $value)
				return $object;
		}
		return null;
	}

	public function getIterator() {
		return new ArrayIterator($this->_objects);
	}

	public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->_objects[] = $value;
        } else {
            $this->_objects[$offset] = $value;
        }
    }
    public function offsetExists($offset) {
        return isset($this->_objects[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->_objects[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->_objects[$offset]) ? $this->_objects[$offset] : null;
    }

	protected function ensureFieldExists($field) {
		if ($this->_attributes === null)
			$this->_attributes = array_keys($this->_objects[array_rand($this->_objects)]->getAttributes());
		return isset($this->_attributes[$field]);
	}
}
