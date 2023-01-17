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

// create_student(id, name) creates a new student record with given id and name;
// allocates memory to store structure and name (must free with free_student)
// and returns NULL if memory allocation fails
// requires: name points to a valid string
struct student *create_student(int id, char *name) {
  // name is length n
  struct student *s = malloc(sizeof(struct student));

  if (s == NULL) {
    return NULL;
  }
  // will initialize our studdent id from the parameter
  s->id = id;

  // str len is O(n) so at this point our function is O(n)
  int length = strlen(name);
  // string bob in c we need room for bob\0
  s->name = malloc((length + 1) * sizeof(char));
  if (s->name == NULL) {
    // student will still exist atm
    free(s);
    // assert(s==NULL);
    return NULL;
  }

  // copies the name passed into the parameter into students name
  // strcpy is also O(n)
  strcpy(s->name, name);
  // s->name=name;
  // string will be copied using the strcpy function
  // O(n)+O(n)== O(N)
  return s;
}

/*
When working with free you always want to go inside out meaning
s and s has many sub variables
free sub variables
free (s)
*/

int main(void) {
  struct student *s1 = create_student(123, "joe");
  struct student *s2 = create_student(1234, "Boe");
  struct student *s3 = create_student(1235, "Moe");

// assert that function return false && strcmp with name and original name is
// 0

  assert(s1->id == 123);
  assert(s2->id == 1234);
  assert(s3->id == 1235);

  assert(strcmp(s1->name, "joe") == 0);
  assert(strcmp(s2->name, "joe") != 0);
  assert(strcmp(s3->name, "Moe") == 0);
  printf("All tests passed succuessfully\n");
}