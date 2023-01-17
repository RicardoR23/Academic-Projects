/* ===========================================================================
COMP-1410 Lab 8
Ricardo Roufai
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
// all of the node's children
// requires: root is NULL or the root of a tree allocated dynamically
void free_tree(struct node *root) {
  if (root == NULL) {
    return;
  }
  free_tree(root->left);
  free_tree(root->right);
  free(root);
}

// height(root) returns the height of the tree with given root
// requires: root is NULL or points to a valid tree root node
int height(struct node *root) {
  // The Base Case for is the tree is empty
  if (root == NULL) {
    return 0;
  }

  int rootnode = 1;
  //Subtrees
  int lengthleft = height(root->left);
  int lengthright = height(root->right);
  //Base Case if left side of root height is greater or equal to the right side
    if (lengthleft >= lengthright) {
      return (lengthleft + rootnode);
    } 
  //Else this Base Case if right side of root height is greater than or eqal to the left side
    else if (lengthright >= lengthleft) {
      return (lengthright + rootnode);
  }
  return height(root);
}

// concat_leaves(root, str) modifies str to be a string concatenation of the
// leaf nodes of the tree with given root using an in-order traversal;
// returns the length of the concatenated string
// requires: str points to enough memory to store the output string
// root is NULL or points to a valid tree root node
/// TA helped and referenced print_tree function from labs///
int concat_leaves(struct node *root, char *str) {
  // The Base Case for is the tree is empty
  if (root == NULL) {
    return 0;
  }

  int left, right, length = 0;
  //If nodes equals NULL that means the node is a leaf, copy the node and keep adding nodes that are leaves to the back and return the length. Recurse the right side and after add the left and right side to find the total length of the concatenated nodes.
  left = concat_leaves(root->left, str);
  right = concat_leaves(root->right, str + left);
  
  if (root->right == NULL && root->left == NULL) {
    strcpy(str, root->str);
    length = length + strlen(str);
      return length;
  }
  else return left + right;
}

int main(void) {
  /// ASSERTS FOR HEIGHT FUNCTION///
  ////////////NORMAL TESTING////////////
  struct node *meat = create_node("meat", NULL, NULL);
  struct node *apple = create_node("apple", NULL, NULL);
  struct node *pear = create_node("pear", NULL, NULL);
  struct node *fruit = create_node("fruit", apple, pear);
  struct node *food = create_node("food", meat, fruit);
  assert(height(food) == 3);

  // TESTING WITH NO BRANCHES, SIMILAR TO A LINKED LIST//
  struct node *Dog = create_node("Dog", NULL, NULL);
  struct node *Zebra = create_node("Zebra", Dog, NULL);
  struct node *Whale = create_node("Whale", Zebra, NULL);
  struct node *Fish = create_node("Fish", Whale, NULL);
  assert(height(Fish) == 4);

  ////TESTING IF THE ROOT IS THE ONLY LEAF////
  struct node *Watermelon = create_node("Watermelon", NULL, NULL);
  assert(height(Watermelon) == 1);

  /// ASSERTS FOR CONCAT FUNCTION///
  ////////////NORMAL TESTING////////////
  char firststring[100];
  struct node *berry = create_node("berry", NULL, NULL);
  struct node *banana = create_node("banana", NULL, NULL);
  struct node *bread = create_node("bread", NULL, NULL);
  struct node *pizza = create_node("pizza", banana, bread);
  struct node *orange = create_node("orange", berry, pizza);
  assert(concat_leaves(orange, firststring) == 16);

  // TESTING WITH NO BRANCHES, SIMILAR TO A LINKED LIST//
  char secondstring[100];
  struct node *Rat = create_node("Rat", NULL, NULL);
  struct node *Hippo = create_node("Hippo", Rat, NULL);
  struct node *Cat = create_node("Cat", Hippo, NULL);
  struct node *Goat = create_node("Goat", Cat, NULL);
  assert(concat_leaves(Goat, secondstring) == 3);

  ////TESTING IF THE ROOT IS THE ONLY LEAF////
  char thirdstring[100];
  struct node *Grapefruit = create_node("Grapefruit", NULL, NULL);
  assert(concat_leaves(Grapefruit, thirdstring) == 10);
  printf("All tests passed successfully\n");
}