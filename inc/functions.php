<?php

function addStudent($fname, $lname, $roll)
{
    $found = false;
    $serialziedData = file_get_contents('../data/db.txt');
    $students = unserialize($serialziedData);
    foreach ($students as $_student) {
        if ($_student['roll'] == $roll) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $newId = getNewId($students);
        $student = array(
            'id' => $newId,
            'fname' => $fname,
            'lname' => $lname,
            'roll' => $roll
        );
        array_push($students, $student);
        $serializedData = serialize($students);
        file_put_contents('../data/db.txt', $serializedData, LOCK_EX);

        return true;
    }

    return false;
}

function getStudent($id)
{
    $serialziedData = file_get_contents('../data/db.txt');
    $students = unserialize($serialziedData);
    foreach ($students as $student) {
        if ($student['id'] == $id) {
            return $student;
        }
    }

    return false;
}

function updateStudent($id, $fname, $lname, $roll)
{
    $found = false;
    $serialziedData = file_get_contents('../data/db.txt');
    $students = unserialize($serialziedData);
    foreach ($students as $_student) {
        if ($_student['roll'] == $roll && $_student['id'] != $id) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $students[$id - 1]['fname'] = $fname;
        $students[$id - 1]['lname'] = $lname;
        $students[$id - 1]['roll'] = $roll;
        $serializedData = serialize($students);
        file_put_contents('../data/db.txt', $serializedData, LOCK_EX);

        return true;
    }

    return false;
}

function deleteStudent($id)
{
    $serialziedData = file_get_contents('../data/db.txt');
    $students = unserialize($serialziedData);

    foreach ($students as $offset => $student) {
        if ($student['id'] == $id) {
            unset($students[$offset]);
        }

    }
    $serializedData = serialize($students);
    file_put_contents('../data/db.txt', $serializedData, LOCK_EX);
}

function printRaw()
{
    $serialziedData = file_get_contents('../data/db.txt');
    $students = unserialize($serialziedData);
    print_r($students);
}

function getNewId($students)
{
    $maxId = max(array_column($students, 'id'));

    return $maxId + 1;
}


function isAdmin()
{
    return ('admin' == $_SESSION['role']);
}

function isManager()
{
    return ('manager' == $_SESSION['role']);
}

function hasPrivilege()
{
    return (isAdmin() || isManager());
}