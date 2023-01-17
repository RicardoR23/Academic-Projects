/* ===========================================================================
COMP-1410 Lab 7
=========================================================================== */

#include <assert.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

// Linked list node storing a string of at most 4 characters
struct strnode {
  char str[5];
  struct strnode *next;
};

// create_node(str, next) creates a strnode containing the string str
// and given next pointer; caller must free allocated memory using free_node
// requires: str has length at most 4
// next is NULL or points to a strnode
// note: returns NULL if memory cannot be allocated
struct strnode *create_node(char str[], struct strnode *next) {
  struct strnode *new_node = malloc(sizeof(struct strnode));
  if (new_node == NULL) {
    return NULL;
  }

  strcpy(new_node->str, str);
  new_node->next = next;
    return new_node;
  // O(1)
}

// free_node(node) frees the memory associated with the given node; returns a
//  pointer to the next node in the list previously headed by the given node
// requires: node is a valid strnode allocated dynamically
struct strnode *free_node(struct strnode *node) {
  struct strnode *nextnode = node->next;
  free(node);
    return nextnode;
  // O(1)
}

int main() {
  struct strnode *C = create_node("sea", NULL);
  struct strnode *B = create_node("bee", C);
  struct strnode *A = create_node("Ayy", B);

  assert(C->next == NULL);
  assert(B->next == C);
  assert(A->next == B);

  assert(strcmp(A->str, "Ayy") == 0);

  assert(free_node(A) == B);
  assert(free_node(B) == C);
  assert(free_node(C) == NULL);

  printf("All tests passed succuessfully\n");
}