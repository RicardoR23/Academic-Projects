/* ===========================================================================
COMP-1410 Lab 8
Practice Problems
=========================================================================== */

#include <assert.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

// Tree node storing a string of length at most 9
struct node {
  char str[10];
  struct node *left;
  struct node *right;
};

// create_node(str, left, right) creates and returns a tree node containing
// given str and left/right pointers; caller must free allocated memory
// requires: left, right are NULL or point to tree nodes
// note: returns NULL if memory cannot be allocated
struct node *create_node(char str[], struct node *left, struct node *right) {
  struct node *new_node = malloc(sizeof(struct node));
  if (new_node == NULL) {
    return NULL;
  }
  strcpy(new_node->str, str);
  new_node->left = left;
  new_node->right = right;
  return new_node;
}

// free_tree(root) frees the memory associated with the given root node and
//  all of the node's children
// requires: root is NULL or the root of a tree allocated dynamically
void free_tree(struct node *root) {
  if (root == NULL) {
    return;
  }
  free_tree(root->left);
  free_tree(root->right);
  free(root);
}

// print_tree(root) prints the contents of the tree using an in-order traversal
// requires: root is NULL or points to a valid tree root node
void print_tree(struct node *root) {
  if (root == NULL) {
    return;
  }
  print_tree(root->left);
  printf("%s\n", root->str);
  print_tree(root->right);
}

int main(void) {
  struct node *meat = create_node("meat", NULL, NULL);
  struct node *apple = create_node("apple", NULL, NULL);
  struct node *pear = create_node("pear", NULL, NULL);
  struct node *fruit = create_node("fruit", apple, pear);
  struct node *food = create_node("food", meat, fruit);

  // One example for the Assertion
  assert(strcmp(meat->str, "meat") == 0);
  assert(meat->left == NULL);
  assert(meat->right == NULL);
  printf("All tests passed successfully\n");
}