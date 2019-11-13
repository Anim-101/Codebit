/*
Given Number of String, When White Space is encountered new line and space are added from the ending point of first non white space word
or character. And Continue doing it till last String from String Stream is not encountered.

Test Case:
    Input: 
            How Many String: 4
            Enter 4 Strings for Array:
            Hey Hello Anim Akash
    
   OutPut:
            Hey
               Hello
                    Anim
                        Akash

*/

import java.util.Scanner;

public class StringPrint
{
    public static void main(String [] args)
    {
        System.out.print("How Many Strings: ");

        Scanner scan = new Scanner(System.in);

        int number = scan.nextInt();

        String [] string = new String [number];

        System.out.println("Enter " + number + " Strings for Array:");

        System.out.println();

        for(int i = 0; i < number; i ++)
        {
            string [i] = scan.next();
        }

        System.out.println();

        System.out.print("Strings you have Entered: [");

        for(int i = 0; i < number; i++)
        {
            if(i != number - 1)
            {
                System.out.print("'" + string[i] + "'" + " ");
            }
            else
            {
                System.out.print("'" + string[i] + "'");
            }
        }

        System.out.println("]");

        System.out.println();

        System.out.println("Desired Output:");

        System.out.println();

        int space = 0;

        for(int i = 0; i < number; i++)
        {
            if(i == 0)
            {
                space = string[i].length();

                System.out.println(string[i]);
            }
            else
            {
                for(int j = 0; j < space; j++)
                {
                    System.out.print(' ');
                }

                System.out.println(string[i]);

                space = space + 1;
            }            
        }
    }
}
