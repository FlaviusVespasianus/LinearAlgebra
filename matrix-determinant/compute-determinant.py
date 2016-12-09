# this function cumputes any N x N matrix determinant
# matrices are taken from user input

def determine(matrix, size):
    if size == 1:
        newDet = matrix[0]
        return newDet
    #del this is not needed any longer
    # elif size == 2:
    #     newDet = matrix[0] * matrix[3] - matrix[1] * matrix[2]
    #     return newDet
    # elif size == 3:
    #     newDet = matrix[0] * matrix[4] * matrix[8] - matrix[0] * matrix[5] * matrix[7] - \
    #              matrix[1] * matrix[3] * matrix[8] + matrix[1] * matrix[5] * matrix[6] + \
    #              matrix[2] * matrix[3] * matrix[7] - matrix[2] * matrix[4] * matrix[6]
    #     return newDet
    elif size > 1:
        x0 = list(matrix)
        del x0[0:size]
        xForDelCounter = 0
        newDet = 0
        for i in range(1, size+1):
            xCurrent = list(x0)
            delCounter = xForDelCounter
            for ii in range(1, size):
                del xCurrent[delCounter]
                delCounter += size - 1
                if ii == (size - 1):
                    xForDelCounter += 1
            if (i-1) % 2 == 0:
                plus = 1
            else:
                plus = (-1)
            newSummand = plus * matrix[i-1] * determine(list(xCurrent), size-1)
            newDet += newSummand
        return newDet


print("\n\t\t\tHello, welcome to determinanator 2016. v.d4", ("\n\t\t"+"-"*50)*2)
raws = int(input("\nmatrix A, n*n, n = "))

print("Be ready to insert all the elements of your matrix below.\n")
elements = []
for x in range(1, raws+1):               # this loop makes list of matrix ('elements') from inputs
    print("",x,"raw:")
    for y in range(1, raws+1):
        element = int(input(""))
        elements.append(element)

print("Your matrix looks like this: ")
for a in range(0, len(elements)):        # this one just shows how the matrix looks visually
    if (a+1) % raws == 0:
        newline = "\n"
    else:
        newline = " "
    if elements[a] < 10 and elements[a] >= 0:
        beforeLine = " "
    else:
        beforeLine = ""
    print(beforeLine, elements[a], end = newline)

det = determine(elements, raws)        # gives matrix to the function to calculate its determinant
print("Its determinant =", det)
