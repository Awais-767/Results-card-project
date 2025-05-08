<?php
include ('db.php');

$search = isset($_GET['query']) ? trim($_GET['query']) : '';

$sql = "SELECT * FROM studentsresults WHERE roll_number LIKE ? OR student_name LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = "%" . $search . "%";
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Results Search</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Search Student Results</h2>
    <form method="get" class="form-inline mb-4">
        <input type="text" name="query" class="form-control mr-2" placeholder="Enter name or roll number" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['student_name']); ?></h5>
                            <p class="card-text">
                                <strong>Roll No:</strong> <?php echo htmlspecialchars($row['roll_number']); ?><br>
                                <strong>Subject:</strong> <?php echo htmlspecialchars($row['subject']); ?><br>
                                <strong>Marks:</strong> <?php echo htmlspecialchars($row['marks']); ?><br>
                                <strong>Grade:</strong> <?php echo htmlspecialchars($row['grade']); ?><br>
                                <strong>Exam Date:</strong> <?php echo htmlspecialchars($row['exam_date']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning">No records found.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
