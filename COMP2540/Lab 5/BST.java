// QUESTION 2:
public class BST {
    class Node {
        int key;
        Node left, right;

        public Node(int data) {
            key = data;
            left = right = null;
        }
    }

    Node root;
    BST() {
        root = null;
    }

    public void remove(int key) {
        root = deleteNode(root, key);
    }

    Node deleteNode(Node root, int key) {
        // if root is null which means we reached end of tree.
        if (root == null) {
            return root;
        }

        // traverse the tree
        // if key is less than current root, traverse the left subtree
        if (key < root.key) {
            root.left = deleteNode(root.left, key);

        // if key is greater than current root, traverse the right subtree    
        } else if (key > root.key) { 
            root.right = deleteNode(root.right, key);
        } else {

            // node contains only one child
            // if root has no left child, return right
            if (root.left == null) {
                return root.right;
            // if root has no right child, return left
            } else if (root.right == null) {
                return root.left;
            }

            // node has two children;
            // get inorder successor (min value in the right subtree)
            root.key = min(root.right);

            // Call method and delete the inorder successor
            root.right = deleteNode(root.right, root.key);
        }
        return root;
    }

// return minimum value key in tree
    int min(Node root) {
        // initially minval = root (starting point)
        int minval = root.key;
        // find minval by continuing as long as root is not null
        while (root.left != null) {
            // update minval to key of left child and update root node to left child node
            // traverse down the left side
            minval = root.left.key;
            root = root.left;
        }
        return minval;
    }

    void insert(int key) {
        root = insertNode(root, key);
    }

    Node insertNode(Node root, int key) {
        // if tree is empty, insert new node and return it
        if (root == null) {
            root = new Node(key);
            return root;
        }

        // if key is less than root, insert node in left subtree
        else if (key < root.key)
            root.left = insertNode(root.left, key);
        // if key is greater than root, insert node in right subtree
        else if (key > root.key)
            root.right = insertNode(root.right, key);

        // return root of the current subtree that has an updated node
        return root;
    }

// pass the root node and key value, if present return true, otherwise return false
    boolean search(int key) {
        if (searchTree(root, key) != null) {
            return true;
        } else {
            return false;
        }
    }

    // recursive insert function
    private Node searchTree(Node root, int key) {
        // Base Cases: root is null or key is present at root
        if (root == null || root.key == key) {
            return root;
        }
        // value is greater than root's key
        if (root.key > key) {
            return searchTree(root.left, key);
        }
        // value is less than root's key
        return searchTree(root.right, key);
    }

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// QUESTION 3: 
// check left subtree first, print the current node's value and check right subtree
// key values of the nodes are printed in ascending order   
    void inOrderTraversal(Node root) {
        if (root != null) {
            inOrderTraversal(root.left);
            System.out.print(root.key + " ");
            inOrderTraversal(root.right);
        }
    }
}