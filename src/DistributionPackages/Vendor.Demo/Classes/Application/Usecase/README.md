# Use cases

| Use case           | Entity     | Aggregate Root |
|--------------------|------------|----------------|
| Register           | Account    | Account        |
| Login              | Account    | Account        |
| Logout             | Account    | Account        |
| Add Employee       | Employee   | Employee       |
| Clock In           | Timestamp  | Employee       |
| Edit Timestamp     | Timestamp  | Employee       |
| Delete Timestamp   | Timestamp  | Employee       |
| Register Company   | Company    | Company        |
| Add Department     | Department | Company        |
| Get Departments    | Department | Company        |
| Remove Departments | Department | Company        |