# BCS406 Data Structures
# Assignment 1 - Emergency Room Queuing system
# Group members :
# SES181000 Mikhail Bin Abbas
# SES181005 Muhammad Arif Bin Suwarno

# Store patients entries in lists
patientPrioList = []
patientNameList = []
storedPatientNameList = []
storedPatientPrioList = []

# Record file name and path
recordFile = "treatment_records.txt" 

'''
Type : Function
Desc : Clerk mode allows patient entry and priority mapping to each patient
'''
def clericMode():
  state = 1
  while(state == 1):
    state = int(input("Please select option:-\n1) Patient entry\n2) Exit\n\nEnter selection : "))
    # Patient entry
    if (state == 1):
      # Request patient name
      name = input("\nEnter patient name: ")
      # Request patient priority
      prio = int(input("Enter patient priority (1 - lowest priority, 10 - highest priority)\n: "))

      # Append instances into list
      patientNameList.append(name)
      patientPrioList.append(prio)

      # Diplay current patient list
      displayPatientList()

    else:
      print("\nSorting patient list")
      sortingPatientList()
      print("\nReturning to main menu")

'''
Type : Function
Desc : Patient entry list sorting using stable selection sort algorithm 
'''
def sortingPatientList():
  # Traverse through each item in primary sublist
  for item in range(len(patientPrioList)):
    # Find item with lowest priority in unsorted list
    lowPrItem = item
    # Traverse through secondary sublist
    for entry in range(item + 1, len(patientPrioList)):
      # If current node has lower prio, switch index to lower prio item
      if patientPrioList[lowPrItem] < patientPrioList[entry]:
        lowPrItem = entry

    temp = patientPrioList[lowPrItem] # Priority of current patient in head node of list
    swap = patientNameList[lowPrItem] #  Name of current patient in head node of list
    
    # if item has higher prio than next item in list, swap position with previous node in list
    while lowPrItem > item:
      patientPrioList[lowPrItem] = patientPrioList[lowPrItem - 1]
      patientNameList[lowPrItem] = patientNameList[lowPrItem - 1]
      lowPrItem -= 1

    # Reassign value of var with
    patientPrioList[item] = temp
    patientNameList[item] = swap

'''
Type : Function
Desc : Displays current patients in queue as a list
'''
def displayPatientList():
  print("\n\nPatients to be treated:\nName\tPriority")
  # Call entries from patient list
  for x in range(len(patientNameList)):
    print(patientNameList[x],patientPrioList[x], sep='\t')
  print("\n") 
  return

'''
Type : Function
Desc : Allows doctor user to view patient queue, mark patients to be treated and view record of patient treatment
'''
def doctorMode():
  print("\nWelcome back, Doctor!\n")
  state = 1 
  # Loop through until user wants to exit program
  while(state != 0):
    state = int(input("What will you do?\n1) View patient queue\n2) Treat patient\n3) View records\n\nEnter zero (0) to exit.\n\nEnter selection no. : "))
    if (state == 1):
      # Display patient list
      if (len(patientNameList)> 0):
        print("\nThere are patients in queue\n")
        displayPatientList()
      else:
        print("\nThere are no patients in queue\n")
    elif (state == 2):  
      # Treat 1st patient in list
      print("\n",patientNameList[0], "will be treated\n")
      # Put patient name and priority to file
      writeRecords()
      # Remove names upon treatment completion
      patientNameList.pop(0)
      patientPrioList.pop(0)
    elif (state == 3):
      # Allow doctor to view records
      viewRecords()
    else:
      # Go to previous menu on any other input
      print("See you later!\n ")

'''
Type : Function
Desc : Opens file and append new content. If file does not exist, creates file
'''
def writeRecords():
  # Open file and append contents to file
  write_data = open(recordFile,"a")
  # Write patient details using format
  write_data.write("\n " + patientNameList[0] + "\t" + str(patientPrioList[0]))
  # Flush data from memory buffer and close data stream
  write_data.flush
  write_data.close

'''
Type : Function
Desc : Reads records from file and displays them 
'''
def viewRecords():
  # Open file in read mode 
  read_data = open(recordFile,"r")
  # Read contents of file
  try:
    for item in read_data:
      # Read patient names
      temp = read_data.read()
      storedPatientNameList.append(temp)
      # Read patient priority
      temp = read_data.read()
      storedPatientPrioList.append(temp)
  except EOFError:
    print("\nNo more content in file")
    pass
  except FileNotFoundError:
    print("\nFile unavailable or moved. Please recreate file")
    pass

  # Close file reading stream
  read_data.close

  # Display patient list 
  print("\n\nPatients treated:")
  # Call entries from patient list
  for x in range(len(storedPatientNameList)):
    print(storedPatientNameList[x],storedPatientPrioList[x], sep=' ')
  print("\n") 
  return

'''
Type : Function
Desc : Main program function
'''
def main():
  print("Starting program....")
  userMode = 1
  while(userMode != 0):
    # Determine user
    userMode = int(input("Please select user:-\n1) Clerk\n2) Doctor\n\nEnter zero (0) to exit.\n\nEnter selection no. : "))

    if (userMode == 1):
      # Run clerical mode
      clericMode()
    elif (userMode == 2):
      # Run doctor mode
      doctorMode()
    else:
      # Display error
      if (userMode == 0):
        print("Stopping program")
      else:
        print("Please re-enter a proper input.")

# Execute main function
main()