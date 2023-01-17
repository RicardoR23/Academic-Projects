/* ===========================================================================
COMP-1410 Lab 7
Ricardo Roufai
=========================================================================== */

#include <stdio.h>
#include <assert.h>
#include <string.h>
#include <stdlib.h>

// Linked list node storing a string of at most 4 characters
struct strnode {
  char str[5];
  struct strnode * next;
};

// create_node(str, next) creates a strnode containing the string str
// and given next pointer; caller must free allocated memory using free_node
// requires: str has length at most 4
// next is NULL or points to a strnode
// note: returns NULL if memory cannot be allocated
//Given from Lab
struct strnode *create_node(char str[], struct strnode *next) {
  struct strnode *new_node = malloc(sizeof(struct strnode));
  if (new_node == NULL) {
    return NULL;
  }

  strcpy(new_node->str, str);
  new_node->next = next;
    return new_node;
}

// concat_nodes(head, str) modifies str to be a string representation of the
// contents of the list with given head
// requires: str points to enough memory to store the output string
// head is NULL or points to a strnode
void concat_nodes(struct strnode * head, char * str){
  while(head != NULL){  
    if(head->next != NULL){
      strcat(str, strcat(head->str, " "));
      head = head->next;
      continue;
    }
      strcat(str, head->str);
      break;    
  }
}

// free_node(node) frees the memory associated with the given node; returns a
// pointer to the next node in the list previously headed by the given node
// requires: node is a valid strnode allocated dynamically
//Given from Lab//
struct strnode *free_node(struct strnode *node) {
  struct strnode *nextnode = node->next;
  free(node);
    return nextnode;
}

int main(void){
///////////////////////////TEST 1//////////////////////////////
  struct strnode *C = create_node("do", NULL);
  assert(strcmp(C->str, "do") == 0);

  struct strnode *B = create_node("car", C);
  assert(strcmp(B->str, "car") == 0);

  struct strnode *A = create_node("Ri", B);
  assert(strcmp(A->str, "Ri") == 0);

  char product1[10] = "";  
  struct strnode * item1 = A;
  concat_nodes(item1, product1);
    printf("%s", product1);
    assert(strcmp(product1, "Ri car do") == 0);
///////////////////////////TEST 2//////////////////////////////
  struct strnode *F = create_node("Haww", NULL);
  assert(strcmp(F->str, "Haww") == 0);

  struct strnode *E = create_node("Heee", F);
  assert(strcmp(E->str, "Heee") == 0);

  struct strnode *D = create_node("Heee", E);
  assert(strcmp(D->str, "Heee") == 0);

  char product2[15] = "";
  struct strnode * item2 = D;
  concat_nodes(item2, product2);
    printf("\n%s", product2);
    assert(strcmp(product2, "Heee Heee Haww") == 0);
///////////////////////////TEST 3//////////////////////////////
  struct strnode *I = create_node("8910", NULL);
  assert(strcmp(I->str, "8910") == 0);

  struct strnode *H = create_node("4567", I);
  assert(strcmp(H->str, "4567") == 0);

  struct strnode *G = create_node("0123", H);
  assert(strcmp(G->str, "0123") == 0);
  
  char product3[15] = "";
  struct strnode * item3 = G;
  concat_nodes(item3, product3);
    printf("\n%s", product3);
    assert(strcmp(product3, "0123 4567 8910") == 0);
//////////////////////////Alphabet Test////////////////////////
// I had an idea where I could call create_node 26 times. After I would have a for loop that would be working backwards starting at Z. The node that I created for Z would be pointed by the current node. So on an so forth all the way up to A. (Using the ASCII table to decrement in my loop) Basically, I wanted to get a letter, put it in a node and then connect the nodes together by calling concat_node and make a string. I just didn't know how to propely excute that but here is the explanation for it anyways.
  // char str[55];
  // strcut strnode * head = NULL;
  // int i;
  //   for (i = 90; i >= 65; i--){
  //     head = create_node(str, head);
  //     head->data = i;
  //     head->next = NULL;
  //     printf("%s", head);
  //   }
}