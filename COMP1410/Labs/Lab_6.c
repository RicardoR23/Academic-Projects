/* ============================================================================
COMP-1410 Lab 6
Ricardo Roufai - I have used ONE source which was part of the create_student function given from the lab.
============================================================================ */

#include <stdio.h>
#include <assert.h>
#include <string.h>
#include <stdlib.h>
#include <stdbool.h>

struct student * create_student(int id, char * name);
bool change_name(struct student * s, char * new_name);

struct student {
  int id;
  char * name;
};

// create_student(id, name) creates a new student record with given id and name;
// allocates memory to store structure and name (must free with free_student)
// and returns NULL if memory allocation fails
// requires: name points to a valid string
struct student * create_student(int id, char * name){
  struct student * s = malloc(sizeof(struct student));
    if(s == NULL){
      return NULL;
    }

  s->id = id;
    if(name == NULL){
      free(s);
    return NULL;
    }

  s->name = malloc((strlen(name) + 1) * sizeof(char));
    if(s->name == NULL){
      s->name = NULL;
    }
    else{
      strcpy(s->name, name);
    }
    return s;
}

// change_name(s, new_name) renames the student s to have the name given by
// new_name; allocates memory to hold new_name (must free with free_student)
// returns true when the name was successfully changed
// requires: s points to a valid student and new_name points to a valid string
bool change_name(struct student * s, char * new_name){
  s->name = malloc((strlen(new_name) + 1) * sizeof(char));
    if(s->name==NULL){ 
      free(s);
        return 0;
    }
      strcpy(s->name, new_name);
        return 1;
}

// free_student(s) frees the memory associated with the student record s
// requires: s is a student record created using dynamic memory allocation
void free_student(struct student * s){
  free(s->name);
    free(s);
}

int main(void){

struct student *s1 = create_student(110069976, "Ricardo");
struct student *s2 = create_student(0101010101, "Tobey");
struct student *s3 = create_student(1010101010, "Andrew");

  int studentid= 110069976;
  char *myname = "Ricardo";
  char *lastname = "Roufai";
  
  int petar2id = 0101010101;
  char *petar2 = "Tobey";
  char *newname2 = "Maguire";

  int petar3id = 1010101010;
  char *petar3 = "Andrew";
  char *newname3 = "Garfield";
  
  assert(s1->id == studentid),
  assert(strcmp(s1->name, myname) == false);
  
  assert(change_name(s1, lastname));
  assert(strcmp(s1->name, lastname) == false);
  free_student(s1); 
  
  assert(s2->id == petar2id),
  assert(strcmp(s2->name, petar2) == false);
  
  assert(change_name(s2, newname2)),
  assert(strcmp(s2->name, newname2) == false);
  free_student(s2);
    
  assert(s3->id == petar3id),
  assert(strcmp(s3->name, petar3) == false);
  
  assert(change_name(s3, newname3)),
  assert(strcmp(s3->name, newname3) == false);
  free_student(s3);
  printf("All tests passed successfully\n");
}