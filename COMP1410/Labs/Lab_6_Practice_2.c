/* ============================================================================
COMP-1410 Lab 6
============================================================================ */

#include <assert.h>
#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

// Definition of structure for storing student information
struct student {
  int id;
  char *name;
};

struct student *create_student(int id, char *name);

int main() {

  struct student *s1 = create_student(443, "Isaac");
  struct student *s2 = create_student(492, "Kumail");
  struct student *s3 = create_student(124, "Keerat");

  assert(s1->id == 443 && !strcmp(s1->name, "Isaac"));
  assert(s2->id == 492 && !strcmp(s2->name, "Kumail"));
  assert(s3->id == 124 && !strcmp(s3->name, "Keerat"));
  puts("All tests have passed successfully!");
  return 0;
}

struct student *create_student(int id, char *name) {
  // O(1)
  struct student *newStudent = malloc(sizeof(struct student));
  if (newStudent == NULL) {
    return NULL;
  }

  // O(n) strlen, strcpy
  char *studentName = malloc(strlen(name) + 1);
  if (studentName == NULL) {
    free(newStudent);
    return NULL;
  }

  // O(1)
  strcpy(studentName, name);
  newStudent->id = id;
  newStudent->name = studentName;
  return newStudent;
}