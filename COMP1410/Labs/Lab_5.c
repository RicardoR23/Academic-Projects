/* ===========================================================================
COMP-1410 Lab 5
Ricardo Roufai - I have NOT used any outside sources
=========================================================================== */

#include <assert.h>
#include <stdbool.h>
#include <stdio.h>
#include <string.h>

// Definition of structure for storing student information
struct student {
  int id;
  char name[20];
};

// find_name(name, arr, n, ids) searches for student(s) with given name in arr;
// returns the number of students found and the array ids is updated to
// contain the id numbers of those students
// requires: arr has length n
// students in arr have unique ids
// ids points to enough memory to hold the found student ids
int find_name(char *name, struct student arr[], int n, int ids[]) {
  int i, m = 0;
  int names;
  while (i < m) {
    names = strcmp(arr[i].name, name);
    if (names == true){
      arr[i].id = ids[m];
    }
    i++;
  }
  return m;
}

// change_name(s, new_name) renames the student s to have the name given by
// new_name
// requires: s points to a valid student that can be modified
// new_name points to a valid string of length at most 19
void change_name(struct student *s, char *new_name) {
  strcpy(s->name, new_name);
}

int main(void) {
  struct student s1 = {110069976, "Ricardo"};
  struct student s2 = {77, "Peter"};
  struct student s3 = {1, "Tobey"};
  struct student s4 = {215, "Andrew"};
  struct student s5 = {33, "Otto"};

  struct student arr[] = {s1, s2, s3, s4, s5};
  int ids1[20];
  int names1 = find_name("Ricardo", arr, 5, ids1);
  assert(ids1[0] == 110069976);

  int ids2[20];
  int names2 = find_name("Peter", arr, 5, ids2);
  assert(ids2[0] == 77);

  int ids3[20];
  int names3 = find_name("Tobey", arr, 5, ids3);
  assert(ids3[0] == 1);

  int ids4[20];
  int names4 = find_name("Andrew", arr, 5, ids4);
  assert(ids4[0] == 215);

  int ids5[20];
  int names5 = find_name("Otto", arr, 5, ids5);
  assert(ids5[0] == 33);

  assert(strcmp(s1.name, "Ricardo") == 0);
  assert(strcmp(s2.name, "Peter") == 0);
  assert(strcmp(s3.name, "Tobey") == 0);
  assert(strcmp(s4.name, "Andrew") == 0);
  assert(strcmp(s5.name, "Otto") == 0);

  char name[20];
  change_name(&s1, name);
  change_name(&s2, name);
  change_name(&s3, name);
  change_name(&s4, name);
  change_name(&s5, name);

  printf("All tests successfully passed\n");
}