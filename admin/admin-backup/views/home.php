<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<main class="ml-64 p-6 w-full min-h-screen">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
    </div>

    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6 animate__animated animate__fadeIn">จัดการหน้าแรก (Home Page)</h1>

    <!-- การ์ดสำหรับจัดการ Logos -->
    <div class="card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-6 animate__animated animate__fadeInUp">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">จัดการโลโก้</h2>
            <button onclick="showAddLogoModal()" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200">เพิ่มโลโก้</button>
        </div>

        <!-- ตารางแสดงโลโก้ -->
        <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mt-6 mb-3">รายการโลโก้</h3>
        <?php if (empty($GLOBALS['logos'])): ?>
            <p class="text-gray-600 dark:text-gray-400">ยังไม่มีโลโก้ในระบบ</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="logo-table w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="p-3">ID</th>
                            <th class="p-3">รูปภาพ</th>
                            <th class="p-3">ข้อความ Alt</th>
                            <th class="p-3">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($GLOBALS['logos'] as $logo): ?>
                            <tr class="bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                <td class="p-3"><?php echo htmlspecialchars($logo['id']); ?></td>
                                <td class="p-3">
                                    <img src="<?php echo htmlspecialchars($logo['image_url']); ?>" alt="<?php echo htmlspecialchars($logo['alt_text']); ?>" class="max-w-[100px] rounded-lg">
                                </td>
                                <td class="p-3"><?php echo htmlspecialchars($logo['alt_text']); ?></td>
                                <td class="p-3 flex gap-2">
                                    <button class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors duration-200" onclick="showEditLogoModal(<?php echo $logo['id']; ?>, '<?php echo htmlspecialchars($logo['image_url']); ?>', '<?php echo htmlspecialchars($logo['alt_text']); ?>')">แก้ไข</button>
                                    <button class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200" onclick="showDeleteLogoModal(<?php echo $logo['id']; ?>)">ลบ</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- การ์ดสำหรับจัดการ Services -->
    <div class="card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-6 animate__animated animate__fadeInUp">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">จัดการบริการ</h2>
            <button onclick="showAddServiceModal()" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200">เพิ่มบริการ</button>
        </div>

        <!-- ตารางแสดงบริการ -->
        <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mt-6 mb-3">รายการบริการ</h3>
        <?php if (empty($GLOBALS['services'])): ?>
            <p class="text-gray-600 dark:text-gray-400">ยังไม่มีบริการในระบบ</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="service-table w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="p-3">ID</th>
                            <th class="p-3">ไอคอน</th>
                            <th class="p-3">ชื่อบริการ</th>
                            <th class="p-3">รายการที่ 1</th>
                            <th class="p-3">รายการที่ 2</th>
                            <th class="p-3">รายการที่ 3</th>
                            <th class="p-3">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($GLOBALS['services'] as $service): ?>
                            <tr class="bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                <td class="p-3"><?php echo htmlspecialchars($service['id']); ?></td>
                                <td class="p-3">
                                    <img src="<?php echo htmlspecialchars($service['icon_url']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>" class="max-w-[50px] rounded-lg">
                                </td>
                                <td class="p-3"><?php echo htmlspecialchars($service['title']); ?></td>
                                <td class="p-3"><?php echo htmlspecialchars($service['list_item1']); ?></td>
                                <td class="p-3"><?php echo htmlspecialchars($service['list_item2']); ?></td>
                                <td class="p-3"><?php echo htmlspecialchars($service['list_item3']); ?></td>
                                <td class="p-3 flex gap-2">
                                    <button class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors duration-200" onclick="showEditServiceModal(<?php echo $service['id']; ?>, '<?php echo htmlspecialchars($service['icon_url']); ?>', '<?php echo htmlspecialchars($service['title']); ?>', '<?php echo htmlspecialchars($service['list_item1']); ?>', '<?php echo htmlspecialchars($service['list_item2']); ?>', '<?php echo htmlspecialchars($service['list_item3']); ?>')">แก้ไข</button>
                                    <button class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200" onclick="showDeleteServiceModal(<?php echo $service['id']; ?>)">ลบ</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- การ์ดสำหรับจัดการ SomeWorks -->
    <div class="card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-6 animate__animated animate__fadeInUp">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">จัดการผลงาน (SomeWorks)</h2>
            <button onclick="showAddWorkModal()" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200">เพิ่มผลงาน</button>
        </div>

        <!-- ตารางแสดงผลงาน -->
        <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mt-6 mb-3">รายการผลงาน</h3>
        <?php if (empty($GLOBALS['works'])): ?>
            <p class="text-gray-600 dark:text-gray-400">ยังไม่มีผลงานในระบบ</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="work-table w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="p-3">ID</th>
                            <th class="p-3">รูปภาพ</th>
                            <th class="p-3">ชื่อผลงาน</th>
                            <th class="p-3">รายการที่ 1</th>
                            <th class="p-3">รายการที่ 2</th>
                            <th class="p-3">รายการที่ 3</th>
                            <th class="p-3">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($GLOBALS['works'] as $work): ?>
                            <tr class="bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                <td class="p-3"><?php echo htmlspecialchars($work['id']); ?></td>
                                <td class="p-3">
                                    <img src="<?php echo htmlspecialchars($work['image_url']); ?>" alt="<?php echo htmlspecialchars($work['title']); ?>" class="max-w-[100px] rounded-lg">
                                </td>
                                <td class="p-3"><?php echo htmlspecialchars($work['title']); ?></td>
                                <td class="p-3"><?php echo htmlspecialchars($work['list_item1']); ?></td>
                                <td class="p-3"><?php echo htmlspecialchars($work['list_item2']); ?></td>
                                <td class="p-3"><?php echo htmlspecialchars($work['list_item3']); ?></td>
                                <td class="p-3 flex gap-2">
                                    <button class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors duration-200" onclick="showEditWorkModal(<?php echo $work['id']; ?>, '<?php echo htmlspecialchars($work['image_url']); ?>', '<?php echo htmlspecialchars($work['title']); ?>', '<?php echo htmlspecialchars($work['list_item1']); ?>', '<?php echo htmlspecialchars($work['list_item2']); ?>', '<?php echo htmlspecialchars($work['list_item3']); ?>')">แก้ไข</button>
                                    <button class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200" onclick="showDeleteWorkModal(<?php echo $work['id']; ?>)">ลบ</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal สำหรับเพิ่มโลโก้ -->
    <div id="add-logo-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">เพิ่มโลโก้ใหม่</h3>
            <form method="POST" action="">
                <input type="hidden" name="action" value="add_logo">
                <div class="form-group mb-4">
                    <label for="add-logo-image_url" class="block text-gray-700 dark:text-gray-300 mb-1">URL รูปภาพ:</label>
                    <input type="url" id="add-logo-image_url" name="image_url" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-logo-alt_text" class="block text-gray-700 dark:text-gray-300 mb-1">ข้อความ Alt:</label>
                    <input type="text" id="add-logo-alt_text" name="alt_text" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">เพิ่ม</button>
                    <button type="button" onclick="hideAddLogoModal()" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal สำหรับแก้ไขโลโก้ -->
    <div id="edit-logo-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">แก้ไขโลโก้</h3>
            <form method="POST" action="">
                <input type="hidden" name="action" value="edit_logo">
                <input type="hidden" name="id" id="edit-logo-id">
                <div class="form-group mb-4">
                    <label for="edit-logo-image_url" class="block text-gray-700 dark:text-gray-300 mb-1">URL รูปภาพ:</label>
                    <input type="url" id="edit-logo-image_url" name="image_url" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-logo-alt_text" class="block text-gray-700 dark:text-gray-300 mb-1">ข้อความ Alt:</label>
                    <input type="text" id="edit-logo-alt_text" name="alt_text" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">บันทึก</button>
                    <button type="button" onclick="hideEditLogoModal()" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal สำหรับลบโลโก้ -->
    <div id="delete-logo-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">ยืนยันการลบโลโก้</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">คุณแน่ใจหรือไม่ว่าต้องการลบโลโก้นี้?</p>
            <form method="GET" action="">
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="action" value="delete_logo">
                <input type="hidden" name="id" id="delete-logo-id">
                <div class="flex gap-2">
                    <button type="submit" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ลบ</button>
                    <button type="button" onclick="hideDeleteLogoModal()" class="bg-gray-500 text-white p-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal สำหรับเพิ่มบริการ -->
    <div id="add-service-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">เพิ่มบริการใหม่</h3>
            <form method="POST" action="">
                <input type="hidden" name="action" value="add_service">
                <div class="form-group mb-4">
                    <label for="add-service-icon_url" class="block text-gray-700 dark:text-gray-300 mb-1">URL ไอคอน:</label>
                    <input type="url" id="add-service-icon_url" name="icon_url" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-service-title" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อบริการ:</label>
                    <input type="text" id="add-service-title" name="title" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-service-list_item1" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 1:</label>
                    <input type="text" id="add-service-list_item1" name="list_item1" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-service-list_item2" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 2:</label>
                    <input type="text" id="add-service-list_item2" name="list_item2" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-service-list_item3" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 3:</label>
                    <input type="text" id="add-service-list_item3" name="list_item3" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">เพิ่ม</button>
                    <button type="button" onclick="hideAddServiceModal()" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal สำหรับแก้ไขบริการ -->
    <div id="edit-service-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">แก้ไขบริการ</h3>
            <form method="POST" action="">
                <input type="hidden" name="action" value="edit_service">
                <input type="hidden" name="id" id="edit-service-id">
                <div class="form-group mb-4">
                    <label for="edit-service-icon_url" class="block text-gray-700 dark:text-gray-300 mb-1">URL ไอคอน:</label>
                    <input type="url" id="edit-service-icon_url" name="icon_url" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-service-title" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อบริการ:</label>
                    <input type="text" id="edit-service-title" name="title" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-service-list_item1" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 1:</label>
                    <input type="text" id="edit-service-list_item1" name="list_item1" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-service-list_item2" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 2:</label>
                    <input type="text" id="edit-service-list_item2" name="list_item2" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-service-list_item3" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 3:</label>
                    <input type="text" id="edit-service-list_item3" name="list_item3" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">บันทึก</button>
                    <button type="button" onclick="hideEditServiceModal()" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal สำหรับลบบริการ -->
    <div id="delete-service-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">ยืนยันการลบบริการ</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">คุณแน่ใจหรือไม่ว่าต้องการลบบริการนี้?</p>
            <form method="GET" action="">
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="action" value="delete_service">
                <input type="hidden" name="id" id="delete-service-id">
                <div class="flex gap-2">
                    <button type="submit" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ลบ</button>
                    <button type="button" onclick="hideDeleteServiceModal()" class="bg-gray-500 text-white p-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal สำหรับเพิ่มผลงาน -->
    <div id="add-work-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">เพิ่มผลงานใหม่</h3>
            <form method="POST" action="">
                <input type="hidden" name="action" value="add_work">
                <div class="form-group mb-4">
                    <label for="add-work-image_url" class="block text-gray-700 dark:text-gray-300 mb-1">URL รูปภาพ:</label>
                    <input type="url" id="add-work-image_url" name="image_url" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-work-title" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อผลงาน:</label>
                    <input type="text" id="add-work-title" name="title" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-work-list_item1" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 1:</label>
                    <input type="text" id="add-work-list_item1" name="list_item1" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-work-list_item2" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 2:</label>
                    <input type="text" id="add-work-list_item2" name="list_item2" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="add-work-list_item3" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 3:</label>
                    <input type="text" id="add-work-list_item3" name="list_item3" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">เพิ่ม</button>
                    <button type="button" onclick="hideAddWorkModal()" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal สำหรับแก้ไขผลงาน -->
    <div id="edit-work-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">แก้ไขผลงาน</h3>
            <form method="POST" action="">
                <input type="hidden" name="action" value="edit_work">
                <input type="hidden" name="id" id="edit-work-id">
                <div class="form-group mb-4">
                    <label for="edit-work-image_url" class="block text-gray-700 dark:text-gray-300 mb-1">URL รูปภาพ:</label>
                    <input type="url" id="edit-work-image_url" name="image_url" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-work-title" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อผลงาน:</label>
                    <input type="text" id="edit-work-title" name="title" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-work-list_item1" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 1:</label>
                    <input type="text" id="edit-work-list_item1" name="list_item1" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-work-list_item2" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 2:</label>
                    <input type="text" id="edit-work-list_item2" name="list_item2" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="form-group mb-4">
                    <label for="edit-work-list_item3" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 3:</label>
                    <input type="text" id="edit-work-list_item3" name="list_item3" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">บันทึก</button>
                    <button type="button" onclick="hideEditWorkModal()" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal สำหรับลบผลงาน -->
    <div id="delete-work-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">ยืนยันการลบผลงาน</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">คุณแน่ใจหรือไม่ว่าต้องการลบผลงานนี้?</p>
            <form method="GET" action="">
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="action" value="delete_work">
                <input type="hidden" name="id" id="delete-work-id">
                <div class="flex gap-2">
                    <button type="submit" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ลบ</button>
                    <button type="button" onclick="hideDeleteWorkModal()" class="bg-gray-500 text-white p-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
// แสดง Loading Overlay เมื่อโหลดหน้า
document.addEventListener('DOMContentLoaded', function() {
    const loadingOverlay = document.getElementById('loading-overlay');
    loadingOverlay.classList.remove('hidden');
    setTimeout(() => {
        loadingOverlay.classList.add('hidden');
    }, 1000);
});

// ฟังก์ชันสำหรับจัดการ Modal เพิ่มโลโก้
function showAddLogoModal() {
    document.getElementById('add-logo-modal').classList.remove('hidden');
}

function hideAddLogoModal() {
    document.getElementById('add-logo-modal').classList.add('hidden');
}

// ฟังก์ชันสำหรับจัดการ Modal แก้ไขโลโก้
function showEditLogoModal(id, image_url, alt_text) {
    document.getElementById('edit-logo-id').value = id;
    document.getElementById('edit-logo-image_url').value = image_url;
    document.getElementById('edit-logo-alt_text').value = alt_text;
    document.getElementById('edit-logo-modal').classList.remove('hidden');
}

function hideEditLogoModal() {
    document.getElementById('edit-logo-modal').classList.add('hidden');
}

// ฟังก์ชันสำหรับจัดการ Modal ลบโลโก้
function showDeleteLogoModal(id) {
    document.getElementById('delete-logo-id').value = id;
    document.getElementById('delete-logo-modal').classList.remove('hidden');
}

function hideDeleteLogoModal() {
    document.getElementById('delete-logo-modal').classList.add('hidden');
}

// ฟังก์ชันสำหรับจัดการ Modal เพิ่มบริการ
function showAddServiceModal() {
    document.getElementById('add-service-modal').classList.remove('hidden');
}

function hideAddServiceModal() {
    document.getElementById('add-service-modal').classList.add('hidden');
}

// ฟังก์ชันสำหรับจัดการ Modal แก้ไขบริการ
function showEditServiceModal(id, icon_url, title, list_item1, list_item2, list_item3) {
    document.getElementById('edit-service-id').value = id;
    document.getElementById('edit-service-icon_url').value = icon_url;
    document.getElementById('edit-service-title').value = title;
    document.getElementById('edit-service-list_item1').value = list_item1;
    document.getElementById('edit-service-list_item2').value = list_item2;
    document.getElementById('edit-service-list_item3').value = list_item3;
    document.getElementById('edit-service-modal').classList.remove('hidden');
}

function hideEditServiceModal() {
    document.getElementById('edit-service-modal').classList.add('hidden');
}

// ฟังก์ชันสำหรับจัดการ Modal ลบบริการ
function showDeleteServiceModal(id) {
    document.getElementById('delete-service-id').value = id;
    document.getElementById('delete-service-modal').classList.remove('hidden');
}

function hideDeleteServiceModal() {
    document.getElementById('delete-service-modal').classList.add('hidden');
}

// ฟังก์ชันสำหรับจัดการ Modal เพิ่มผลงาน
function showAddWorkModal() {
    document.getElementById('add-work-modal').classList.remove('hidden');
}

function hideAddWorkModal() {
    document.getElementById('add-work-modal').classList.add('hidden');
}

// ฟังก์ชันสำหรับจัดการ Modal แก้ไขผลงาน
function showEditWorkModal(id, image_url, title, list_item1, list_item2, list_item3) {
    document.getElementById('edit-work-id').value = id;
    document.getElementById('edit-work-image_url').value = image_url;
    document.getElementById('edit-work-title').value = title;
    document.getElementById('edit-work-list_item1').value = list_item1;
    document.getElementById('edit-work-list_item2').value = list_item2;
    document.getElementById('edit-work-list_item3').value = list_item3;
    document.getElementById('edit-work-modal').classList.remove('hidden');
}

function hideEditWorkModal() {
    document.getElementById('edit-work-modal').classList.add('hidden');
}

// ฟังก์ชันสำหรับจัดการ Modal ลบผลงาน
function showDeleteWorkModal(id) {
    document.getElementById('delete-work-id').value = id;
    document.getElementById('delete-work-modal').classList.remove('hidden');
}

function hideDeleteWorkModal() {
    document.getElementById('delete-work-modal').classList.add('hidden');
}

// Dark Mode Toggle
document.getElementById('dark-mode-toggle').addEventListener('click', function() {
    document.body.classList.toggle('dark');
    const icon = this.querySelector('i');
    if (document.body.classList.contains('dark')) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    }
});
</script>

<?php include 'partials/footer.php'; ?>