/* ===========================================================================
COMP-1410 Lab 5 Practice
=========================================================================== */

#include <stdio.h>
#include <assert.h>
#include <string.h>
#include <stdbool.h>

// Definition of structure for storing student information
struct student {
 int id;
 char name[20];
};

// find_id(id, arr, n, found_name) searches for a student with given id in arr;
// returns true if such a student is found and found_name is updated to
// hold the student's name; otherwise returns false
// requires: arr has length n
// students in arr have unique ids
// found_name points to enough memory to hold a name

bool find_id(int id, struct student arr[], int n, char * found_name);

int main(void) {
  /*
  struct student --> id, name
  */

  struct student s1 = {1234567, "Bob the builder"};
  struct student s2 = {1, "Juan" };
  struct student s3 = {222, "Ted" };
  struct student s4 = {78, "Robin"};
  struct student s5 = {31, "james"};

  struct student students[5] = {s1, s2, s3, s4, s5};
  char found_name[20];
  assert(find_id(222, students, 5, found_name));
  assert(strcmp(found_name, "Ted") == 0);
  assert(find_id(31, students, 5, found_name));

  struct student students2[2] = {{4, "Alice"}, {22, "Jen"}};
  char found_name2[20];
  assert(find_id(4, students2, 2, found_name2) == true);
  assert(strcmp(found_name2, "Alice") == 0);
  assert(find_id(23, students2, 2, found_name2) == false);
  printf("All tests passed successfully\n");

  // s1.id : s1's id
  // s1.name : s1's name
  //struct * student ps1 = &s1;
  // s1->id : s1's id
  // s1->name : s1's name
}

bool find_id(int id, struct student arr[], int n, char * found_name) {
  //strcpy(s1, s2) --> copies s2 to s1
  for (int i = 0; i < n; i++) {
    if (id == arr[i].id) { // struct student
      strcpy(found_name, arr[i].name);
      return true;
    }
  }
  return false;
}

// Lab 5 Marked Question
int find_name(char * name, struct student arr[], int n, int ids[]);
  /* counter
  // loop through arr
    // if name == arr[i].name
      // add id to ids[]
      // inc counter
  // return counter
}*/

//Examples of Output
// struct student students = {{123, "Laila"}, {123, "Laila"}};
// find_name("Laila") --> 2 --. ids = {123,123}

// struct student class = {{123, "bob"}, {678, "bob"}, {22, "jack"}, {1103971, "cam"}};
// find_name("bob") --> 2 --> ids = {123, 678}
// find_name("jack") --> 1 --> ids = {22}