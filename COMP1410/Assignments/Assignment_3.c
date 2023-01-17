/* ===========================================================================
COMP-1410 Assignment 3
Ricardo Roufai
=========================================================================== */

#include <assert.h>
#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

// Linked list node that holds a student record
struct snode {
  int id;
  char *name;
  struct snode *next;
};

// Student list structure
struct slist {
  struct snode *front;
};

struct treenode {
  char word[10];
  int value;
  struct treenode *left;
  struct treenode *right;
};

struct treenode *new_leaf(int i) {
  struct treenode *leaf = malloc(sizeof(struct treenode));
  leaf->value = i;
  leaf->left = NULL;
  leaf->right = NULL;
  return leaf;
}

// create_list() returns an empty newly-created list of students
// note: caller must free using free_list
struct slist *create_list() {
  struct slist *lst = malloc(sizeof(struct slist));
  lst->front = NULL;
  return lst;
};

// insert_student(id, name, lst) attempts to add a student with given id and
// name into the given list lst; if a student with that id is already in the
// list then return false, otherwise lst is modified and true is returned
bool insert_student(int id, char name[], struct slist *lst){
struct snode *prev_node = NULL;
  if (lst->front->id == NULL){
    return 0;
      }
  else {
  struct snode *curnode = lst->front;
    while (curnode->next && id > curnode->next->id) {
    curnode = curnode->next;
    }
    
  struct snode *nextnode = malloc(sizeof(struct slist));
  if (nextnode == NULL){
    return 0;
  }
  else {
  while(curnode->id < id){
    prev_node = curnode;
    curnode = curnode->next;
  }

  prev_node->next = nextnode;
  nextnode->next = curnode;
  return true;     
  }
    
  nextnode->id = id;
  nextnode->next = curnode->next;
  curnode->next = nextnode;
  return 0;
  }
}

// remove_student(id, lst) attempts to remove a student with given id from the
// given list and free the memory allocated to that student; true is returned
// if successful and false otherwise
bool remove_student(int id, struct slist *lst) {
  if(id == lst->front->id){
  struct snode *name = lst->front;
  lst->front = lst->front->next;
  free(name);
  return 0;
  }
return false;
}

// find_student(id, lst) returns the name of the student with given id in the
// given list lst in a dynamically-allocated string (that the caller must
// free) or NULL if no student has that id
char *find_student(int id, struct slist *lst){
struct snode *curnode;
  int index = -1;
  int count = 0;
  while (curnode != NULL) {
    if(curnode->next->id == id){
      index = count;
      return curnode->next->name;
    }
    curnode = curnode->next;
    count += 1;
  }
  return NULL;
}

// free_list (lst) deallocates all memory associated with the given list lst
// including the memory used by the student records in the list
void free_list(struct slist *lst) {
  struct snode *curnode = lst->front;
  struct snode *nextnode = NULL;
  while (curnode) {
    nextnode = curnode->next;
    free(curnode);
    curnode = nextnode;
  }
  free(lst);
}

// merge_lists(out, lst1 , lst2) merges the student records from lst1 and lst2
// into the list out with the students in sorted order;
// lst1 and lst2 are then freed
// requires: out starts as an empty list
// void merge_lists(struct slist * out, struct slist * lst1 , struct slist * lst2);

// Next, test that merge_list works correctly by writing a function that accepts a list and returns true
// if the list is sorted and false if not. Use your function with assert to verify the lists produced by
// merge_list are sorted. Your testing must not leak memory and should have good test coverage of
// any edge cases.
// void SortList(struct slist *node){
//   int temp;
//   for(struct slist *i =val; i->next!=NULL; i=i->next){
//     for(ListNode *j = i->next; j!=NULL; j= j->next){
//       if(i->word>j->word){
//         temp = i->word;
//         i->word = j->word;
//         j->word = temp;
//         return false
//       }
//     }
//   }
// }

// insert_node(word , value , tree) inserts a new node containing the given word
// and value into the tree with given root (or NULL denoting an empty tree)
// returns the root node of the tree following the insert
// requires: word is not already in the given tree
// tree satisfies the ordering property
//FIRST VERSION OF INSERT_NODE FUNCTION
struct treenode *insert_node(char word[], int value, struct treenode *tree) {
  struct treenode *node = tree->word;
  struct treenode *parent = NULL;
  while (node != NULL) {
    parent = node;
      if (value < node->value) {
        node = node->left;
      } 
      else if (value > node->value){
        node = node->right;
      }
  }  
  if (node != NULL) { 
    free(node->value);
      node->value = my_strdup(word);
  } 
    else if (parent == NULL) { 
      tree->value = new_leaf(value);
    } 
    else if (value < parent->left) {
      parent->left = new_leaf(value);
  } 
  else {
    parent->right = new_leaf(value);
  }
}  

//SECOND VERSION OF INSERT_NODE FUNCTION
//   if (value < tree->word) {
//     if (tree->left) {
//       insert_node(value, tree->left, word);
//     } else {
//       tree->left = new_leaf(value);
//     }
//   } else if (value > tree->word) {
//     if (tree->right) {
//       insert_node(value, tree->right, word);
//   } else {
//     tree->right = new_leaf(value);
//     }
//   }
// }  

// lookup_word(word , tree) returns the numeric value associated with the
// given word in the given tree (or 0 if the word does not appear in the
// tree); tree points to the root node or is NULL (denoting an empty tree)
// requires: tree satisfies the ordering property
//FIRST VERSION OF the LOOKUP_WORD FUNCTION
int lookup_word(char word[], struct treenode *tree){
  struct treenode *node = tree->word;
  while (node) {
    if (node->word == word) {
      return node->value;
    }
    if (word < node->word) {
      node = node->left;
    } else {
      node = node->right;
    }
  }
  return NULL;
}

//SECOND VERSION OF THE LOOKUP_WORD FUNCTION
// int lookup_word(char word[], struct treenode *tree){
//   if(tree == NULL){
//     return NULL;
//   }
//   if(tree->value == word){
//     return tree;
//   }
//   if(tree->value > word)
//     return lookup_word(tree->left, word);
//   else
//     return lookup_word(tree->right, word);
// }

// free_tree(tree) frees all memory associated in the tree with given root
// node
void free_tree(struct treenode * tree){
  if (tree == NULL) {
    return;
  }
  free_tree(tree->left);
  free_tree(tree->right);
  free(tree);
}

int main(void){
  //Linked listed created for the merge_list function
  struct slist* lst1 = create_list();
  struct slist* lst2 = create_list();
  struct slist* out = create_list();

  //Inserting names and ids for lst1
  insert_student(15, "Ricardo", lst1);
  insert_student(2, "Isaac", lst1);
  insert_student(23, "Justin", lst1);

  //Inserting names and ids for lst2
  insert_student(44, "Zach", lst2);
  insert_student(11, "Otto", lst2);
  insert_student(81, "Goblin", lst2);

  //Testing the find_student function for finding and not finding the student in the linked lists above
  assert(strcmp(find_student(15, lst1), "Ricardo") == 0);
  assert(find_student(100, lst2) == NULL);

  // merge_lists(out, list1, list2);

  //For the program that reads the words seperated by spaces, I was thinking of using a while loop. For example while(!='.') or even while(scanf != '') just so it would stop at the period. I would call the function to store each word and end at inner and outer. I tried to use getchar() but that didn't seem to work. After I wouldv'e used %s in scanf to scan the whole line until it reaches that space mentioned before.
  
  //FIRST TEST FOR LOOK_UPWORD
  char firststring[100];
  struct treenode *meat = insert_node("meat", NULL, NULL);
  struct treenode *apple = insert_node("apple", NULL, NULL);
  struct treenode *pear = insert_node("pear", NULL, NULL);
  struct treenode *fruit = insert_node("fruit", apple, pear);
  struct treenode *food = insert_node("food", meat, fruit);
  assert(lookup_word(meat, firststring) == "food fruit pear apple meat");

  //SECOND TESTING LOOK_UPWORD
  char secondstring[100];
  struct treenode *berry = insert_node("berry", NULL, NULL);
  struct treenode *veggie = insert_node("veggie", NULL, NULL);
  struct treenode *carrot = insert_node("carrot", NULL, NULL);
  struct treenode *kiwi = insert_node("kiwi", NULL, NULL);
  struct treenode *tomato = insert_node("tomato", NULL, NULL);
  assert(lookup_word(berry, secondstring) == "tomato kiwi carrot veggie berry");

  //THIRD TESTING LOOK_UPWORD
  char thirdstring[100];
  struct treenode *grape = insert_node("grape", NULL, NULL);
  assert(lookup_word(grape, thirdstring) == "grape");
  
  //FOURTH TESTING LOOK_UPWORD
  // char fourthstring[100];
  // struct treenode *seven = insert_node("seven", NULL, NULL);
  // struct treenode *seven = insert_node("seven", NULL, NULL);
  // struct treenode *seven = insert_node("seven", NULL, NULL);
  // struct treenode *seven = insert_node("seven", seven, seven);
  // struct treenode *seven = insert_node("seven", seven, seven);
  // assert(lookup_word(seven, fourthstring) == "seven seven seven seven seven");
  printf("All tests passed successfully\n");
}