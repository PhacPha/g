<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<main class="admin-main-content ml-64 p-6 w-full min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Loading Overlay -->
    <div id="admin-loading-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
    </div>

    <h1 class="admin-page-title text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8 animate__animated animate__fadeIn">จัดการหน้าแรก (Home Page)</h1>

    <!-- Logos Section -->
    <section class="admin-section-logos bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
        <div class="admin-section-header flex justify-between items-center mb-6">
            <h2 class="admin-section-title text-2xl font-semibold text-gray-800 dark:text-gray-100">จัดการโลโก้</h2>
            <button onclick="showAddLogoModal()" class="admin-button-add bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200">เพิ่มโลโก้</button>
        </div>

        <div class="admin-items-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (empty($GLOBALS['logos'])): ?>
                <p class="admin-empty-message text-gray-600 dark:text-gray-400 col-span-full text-center">ยังไม่มีโลโก้ในระบบ</p>
            <?php else: ?>
                <?php foreach ($GLOBALS['logos'] as $logo): ?>
                    <div class="admin-item-card bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                        <div class="admin-item-image mb-4">
                            <?php if (!empty($logo['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($logo['image_url']); ?>" alt="<?php echo htmlspecialchars($logo['alt_text']); ?>" class="w-32 h-32 object-cover rounded-lg" data-placeholder="/iconnex_thailand_db/img/placeholder.png">
                            <?php else: ?>
                                <img src="/iconnex_thailand_db/img/placeholder.png" alt="Placeholder" class="w-32 h-32 object-cover rounded-lg">
                                <p class="text-red-500 text-sm mt-1">ไม่มีรูปภาพ</p>
                            <?php endif; ?>
                        </div>
                        <div class="admin-item-details">
                            <p class="text-gray-700 dark:text-gray-200"><strong>Alt Text:</strong> <?php echo htmlspecialchars($logo['alt_text']); ?></p>
                        </div>
                        <div class="admin-item-actions mt-4 flex gap-2">
                            <button class="admin-button-edit bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition-colors duration-200" onclick="showEditLogoModal(<?php echo $logo['id']; ?>, '<?php echo htmlspecialchars($logo['image_url']); ?>', '<?php echo htmlspecialchars($logo['alt_text']); ?>')">แก้ไข</button>
                            <button class="admin-button-delete bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition-colors duration-200" onclick="showDeleteLogoModal(<?php echo $logo['id']; ?>)">ลบ</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Services Section -->
    <section class="admin-section-services bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
        <div class="admin-section-header flex justify-between items-center mb-6">
            <h2 class="admin-section-title text-2xl font-semibold text-gray-800 dark:text-gray-100">จัดการบริการ</h2>
            <button onclick="showAddServiceModal()" class="admin-button-add bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200">เพิ่มบริการ</button>
        </div>

        <div class="admin-items-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (empty($GLOBALS['services'])): ?>
                <p class="admin-empty-message text-gray-600 dark:text-gray-400 col-span-full text-center">ยังไม่มีบริการในระบบ</p>
            <?php else: ?>
                <?php foreach ($GLOBALS['services'] as $service): ?>
                    <div class="admin-item-card bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                        <div class="admin-item-image mb-4">
                            <?php if (!empty($service['icon_url'])): ?>
                                <img src="<?php echo htmlspecialchars($service['icon_url']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>" class="w-16 h-16 object-cover rounded-lg" data-placeholder="/iconnex_thailand_db/img/placeholder.png">
                            <?php else: ?>
                                <img src="/iconnex_thailand_db/img/placeholder.png" alt="Placeholder" class="w-16 h-16 object-cover rounded-lg">
                                <p class="text-red-500 text-sm mt-1">ไม่มีไอคอน</p>
                            <?php endif; ?>
                        </div>
                        <div class="admin-item-details">
                            <p class="text-gray-700 dark:text-gray-200"><strong>ชื่อ:</strong> <?php echo htmlspecialchars($service['title']); ?></p>
                            <ul class="text-gray-600 dark:text-gray-400 text-sm mt-2">
                                <li><?php echo htmlspecialchars($service['list_item1']); ?></li>
                                <li><?php echo htmlspecialchars($service['list_item2']); ?></li>
                                <li><?php echo htmlspecialchars($service['list_item3']); ?></li>
                            </ul>
                        </div>
                        <div class="admin-item-actions mt-4 flex gap-2">
                            <button class="admin-button-edit bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition-colors duration-200" onclick="showEditServiceModal(<?php echo $service['id']; ?>, '<?php echo htmlspecialchars($service['icon_url']); ?>', '<?php echo htmlspecialchars($service['title']); ?>', '<?php echo htmlspecialchars($service['list_item1']); ?>', '<?php echo htmlspecialchars($service['list_item2']); ?>', '<?php echo htmlspecialchars($service['list_item3']); ?>')">แก้ไข</button>
                            <button class="admin-button-delete bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition-colors duration-200" onclick="showDeleteServiceModal(<?php echo $service['id']; ?>)">ลบ</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Works Section -->
    <section class="admin-section-works bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
        <div class="admin-section-header flex justify-between items-center mb-6">
            <h2 class="admin-section-title text-2xl font-semibold text-gray-800 dark:text-gray-100">จัดการผลงาน</h2>
            <button onclick="showAddWorkModal()" class="admin-button-add bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200">เพิ่มผลงาน</button>
        </div>

        <div class="admin-items-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (empty($GLOBALS['works'])): ?>
                <p class="admin-empty-message text-gray-600 dark:text-gray-400 col-span-full text-center">ยังไม่มีผลงานในระบบ</p>
            <?php else: ?>
                <?php foreach ($GLOBALS['works'] as $work): ?>
                    <div class="admin-item-card bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                        <div class="admin-item-image mb-4">
                            <?php if (!empty($work['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($work['image_url']); ?>" alt="<?php echo htmlspecialchars($work['title']); ?>" class="w-32 h-32 object-cover rounded-lg" data-placeholder="/iconnex_thailand_db/img/placeholder.png">
                            <?php else: ?>
                                <img src="/iconnex_thailand_db/img/placeholder.png" alt="Placeholder" class="w-32 h-32 object-cover rounded-lg">
                                <p class="text-red-500 text-sm mt-1">ไม่มีรูปภาพ</p>
                            <?php endif; ?>
                        </div>
                        <div class="admin-item-details">
                            <p class="text-gray-700 dark:text-gray-200"><strong>ชื่อ:</strong> <?php echo htmlspecialchars($work['title']); ?></p>
                            <ul class="text-gray-600 dark:text-gray-400 text-sm mt-2">
                                <li><?php echo htmlspecialchars($work['list_item1']); ?></li>
                                <li><?php echo htmlspecialchars($work['list_item2']); ?></li>
                                <li><?php echo htmlspecialchars($work['list_item3']); ?></li>
                            </ul>
                        </div>
                        <div class="admin-item-actions mt-4 flex gap-2">
                            <button class="admin-button-edit bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition-colors duration-200" onclick="showEditWorkModal(<?php echo $work['id']; ?>, '<?php echo htmlspecialchars($work['image_url']); ?>', '<?php echo htmlspecialchars($work['title']); ?>', '<?php echo htmlspecialchars($work['list_item1']); ?>', '<?php echo htmlspecialchars($work['list_item2']); ?>', '<?php echo htmlspecialchars($work['list_item3']); ?>')">แก้ไข</button>
                            <button class="admin-button-delete bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition-colors duration-200" onclick="showDeleteWorkModal(<?php echo $work['id']; ?>)">ลบ</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="admin-section-testimonials bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
        <div class="admin-section-header flex justify-between items-center mb-6">
            <h2 class="admin-section-title text-2xl font-semibold text-gray-800 dark:text-gray-100">จัดการคอมเมนต์</h2>
            <button onclick="showAddTestimonialModal()" class="admin-button-add bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200">เพิ่มคอมเมนต์</button>
        </div>

        <div class="admin-items-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (empty($GLOBALS['testimonials'])): ?>
                <p class="admin-empty-message text-gray-600 dark:text-gray-400 col-span-full text-center">ยังไม่มีคอมเมนต์ในระบบ</p>
            <?php else: ?>
                <?php foreach ($GLOBALS['testimonials'] as $testimonial): ?>
                    <div class="admin-item-card bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                        <div class="admin-item-image mb-4 flex items-center">
                            <?php if (!empty($testimonial['avatar_url'])): ?>
                                <img src="<?php echo htmlspecialchars($testimonial['avatar_url']); ?>" alt="<?php echo htmlspecialchars($testimonial['author_name']); ?>" class="w-12 h-12 object-cover rounded-full mr-3" data-placeholder="/iconnex_thailand_db/img/default-avatar.png">
                            <?php else: ?>
                                <img src="/iconnex_thailand_db/img/default-avatar.png" alt="Default-avatar" class="w-12 h-12 object-cover rounded-full mr-3">
                                <p class="text-red-500 text-sm">ไม่มีรูปภาพ</p>
                            <?php endif; ?>
                            <div>
                                <p class="text-gray-700 dark:text-gray-200 font-semibold"><?php echo htmlspecialchars($testimonial['author_name']); ?></p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm"><?php echo htmlspecialchars($testimonial['author_location']); ?></p>
                            </div>
                        </div>
                        <div class="admin-item-details">
                            <p class="text-gray-700 dark:text-gray-200"><strong>คำพูด:</strong> <?php echo htmlspecialchars($testimonial['quote']); ?></p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-2"><?php echo htmlspecialchars($testimonial['text']); ?></p>
                        </div>
                        <div class="admin-item-actions mt-4 flex gap-2">
                            <button class="admin-button-edit bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition-colors duration-200" onclick="showEditTestimonialModal(<?php echo $testimonial['id']; ?>, '<?php echo htmlspecialchars($testimonial['quote']); ?>', '<?php echo htmlspecialchars($testimonial['text']); ?>', '<?php echo htmlspecialchars($testimonial['author_name']); ?>', '<?php echo htmlspecialchars($testimonial['author_location']); ?>', '<?php echo htmlspecialchars($testimonial['avatar_url']); ?>')">แก้ไข</button>
                            <button class="admin-button-delete bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition-colors duration-200" onclick="showDeleteTestimonialModal(<?php echo $testimonial['id']; ?>)">ลบ</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Modals -->
    <!-- Add Logo Modal -->
    <div id="add-logo-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">เพิ่มโลโก้ใหม่</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_logo">
                <div class="admin-form-group mb-4">
                    <label for="add-logo-image" class="block text-gray-700 dark:text-gray-300 mb-1">รูปภาพ (อัปโหลดหรือวาง URL):</label>
                    <div class="flex items-center gap-2">
                        <input type="file" id="add-logo-image" name="image" accept="image/*" class="admin-input-file w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500 dark:text-gray-400">หรือ</span>
                        <input type="url" id="add-logo-image_url" name="image_url" placeholder="วาง URL รูปภาพ" class="admin-input-url w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-logo-alt_text" class="block text-gray-700 dark:text-gray-300 mb-1">ข้อความ Alt:</label>
                    <input type="text" id="add-logo-alt_text" name="alt_text" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-submit bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">เพิ่ม</button>
                    <button type="button" onclick="hideAddLogoModal()" class="admin-button-cancel bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Logo Modal -->
    <div id="edit-logo-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">แก้ไขโลโก้</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_logo">
                <input type="hidden" name="id" id="edit-logo-id">
                <div class="admin-form-group mb-4">
                    <label for="edit-logo-image" class="block text-gray-700 dark:text-gray-300 mb-1">รูปภาพ (อัปโหลดหรือวาง URL):</label>
                    <div class="flex items-center gap-2">
                        <input type="file" id="edit-logo-image" name="image" accept="image/*" class="admin-input-file w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500 dark:text-gray-400">หรือ</span>
                        <input type="url" id="edit-logo-image_url" name="image_url" placeholder="วาง URL รูปภาพ" class="admin-input-url w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-logo-alt_text" class="block text-gray-700 dark:text-gray-300 mb-1">ข้อความ Alt:</label>
                    <input type="text" id="edit-logo-alt_text" name="alt_text" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-submit bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">บันทึก</button>
                    <button type="button" onclick="hideEditLogoModal()" class="admin-button-cancel bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Logo Modal -->
    <div id="delete-logo-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">ยืนยันการลบโลโก้</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">คุณแน่ใจหรือไม่ว่าต้องการลบโลโก้นี้?</p>
            <form method="GET" action="">
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="action" value="delete_logo">
                <input type="hidden" name="id" id="delete-logo-id">
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-delete bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ลบ</button>
                    <button type="button" onclick="hideDeleteLogoModal()" class="admin-button-cancel bg-gray-500 text-white p-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Service Modal -->
    <div id="add-service-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">เพิ่มบริการใหม่</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_service">
                <div class="admin-form-group mb-4">
                    <label for="add-service-icon" class="block text-gray-700 dark:text-gray-300 mb-1">ไอคอน (อัปโหลดหรือวาง URL):</label>
                    <div class="flex items-center gap-2">
                        <input type="file" id="add-service-icon" name="icon" accept="image/*" class="admin-input-file w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500 dark:text-gray-400">หรือ</span>
                        <input type="url" id="add-service-icon_url" name="icon_url" placeholder="วาง URL ไอคอน" class="admin-input-url w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-service-title" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อบริการ:</label>
                    <input type="text" id="add-service-title" name="title" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-service-list_item1" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 1:</label>
                    <input type="text" id="add-service-list_item1" name="list_item1" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-service-list_item2" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 2:</label>
                    <input type="text" id="add-service-list_item2" name="list_item2" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-service-list_item3" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 3:</label>
                    <input type="text" id="add-service-list_item3" name="list_item3" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-submit bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">เพิ่ม</button>
                    <button type="button" onclick="hideAddServiceModal()" class="admin-button-cancel bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div id="edit-service-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">แก้ไขบริการ</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_service">
                <input type="hidden" name="id" id="edit-service-id">
                <div class="admin-form-group mb-4">
                    <label for="edit-service-icon" class="block text-gray-700 dark:text-gray-300 mb-1">ไอคอน (อัปโหลดหรือวาง URL):</label>
                    <div class="flex items-center gap-2">
                        <input type="file" id="edit-service-icon" name="icon" accept="image/*" class="admin-input-file w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500 dark:text-gray-400">หรือ</span>
                        <input type="url" id="edit-service-icon_url" name="icon_url" placeholder="วาง URL ไอคอน" class="admin-input-url w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-service-title" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อบริการ:</label>
                    <input type="text" id="edit-service-title" name="title" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-service-list_item1" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 1:</label>
                    <input type="text" id="edit-service-list_item1" name="list_item1" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-service-list_item2" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 2:</label>
                    <input type="text" id="edit-service-list_item2" name="list_item2" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-service-list_item3" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 3:</label>
                    <input type="text" id="edit-service-list_item3" name="list_item3" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-submit bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">บันทึก</button>
                    <button type="button" onclick="hideEditServiceModal()" class="admin-button-cancel bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Service Modal -->
    <div id="delete-service-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">ยืนยันการลบบริการ</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">คุณแน่ใจหรือไม่ว่าต้องการลบบริการนี้?</p>
            <form method="GET" action="">
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="action" value="delete_service">
                <input type="hidden" name="id" id="delete-service-id">
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-delete bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ลบ</button>
                    <button type="button" onclick="hideDeleteServiceModal()" class="admin-button-cancel bg-gray-500 text-white p-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Work Modal -->
    <div id="add-work-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">เพิ่มผลงานใหม่</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_work">
                <div class="admin-form-group mb-4">
                    <label for="add-work-image" class="block text-gray-700 dark:text-gray-300 mb-1">รูปภาพ (อัปโหลดหรือวาง URL):</label>
                    <div class="flex items-center gap-2">
                        <input type="file" id="add-work-image" name="image" accept="image/*" class="admin-input-file w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500 dark:text-gray-400">หรือ</span>
                        <input type="url" id="add-work-image_url" name="image_url" placeholder="วาง URL รูปภาพ" class="admin-input-url w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-work-title" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อผลงาน:</label>
                    <input type="text" id="add-work-title" name="title" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-work-list_item1" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 1:</label>
                    <input type="text" id="add-work-list_item1" name="list_item1" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-work-list_item2" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 2:</label>
                    <input type="text" id="add-work-list_item2" name="list_item2" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-work-list_item3" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 3:</label>
                    <input type="text" id="add-work-list_item3" name="list_item3" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-submit bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">เพิ่ม</button>
                    <button type="button" onclick="hideAddWorkModal()" class="admin-button-cancel bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Work Modal -->
    <div id="edit-work-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">แก้ไขผลงาน</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_work">
                <input type="hidden" name="id" id="edit-work-id">
                <div class="admin-form-group mb-4">
                    <label for="edit-work-image" class="block text-gray-700 dark:text-gray-300 mb-1">รูปภาพ (อัปโหลดหรือวาง URL):</label>
                    <div class="flex items-center gap-2">
                        <input type="file" id="edit-work-image" name="image" accept="image/*" class="admin-input-file w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500 dark:text-gray-400">หรือ</span>
                        <input type="url" id="edit-work-image_url" name="image_url" placeholder="วาง URL รูปภาพ" class="admin-input-url w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-work-title" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อผลงาน:</label>
                    <input type="text" id="edit-work-title" name="title" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-work-list_item1" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 1:</label>
                    <input type="text" id="edit-work-list_item1" name="list_item1" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-work-list_item2" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 2:</label>
                    <input type="text" id="edit-work-list_item2" name="list_item2" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-work-list_item3" class="block text-gray-700 dark:text-gray-300 mb-1">รายการที่ 3:</label>
                    <input type="text" id="edit-work-list_item3" name="list_item3" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-submit bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">บันทึก</button>
                    <button type="button" onclick="hideEditWorkModal()" class="admin-button-cancel bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Work Modal -->
    <div id="delete-work-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">ยืนยันการลบผลงาน</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">คุณแน่ใจหรือไม่ว่าต้องการลบผลงานนี้?</p>
            <form method="GET" action="">
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="action" value="delete_work">
                <input type="hidden" name="id" id="delete-work-id">
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-delete bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ลบ</button>
                    <button type="button" onclick="hideDeleteWorkModal()" class="admin-button-cancel bg-gray-500 text-white p-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Testimonial Modal -->
    <div id="add-testimonial-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">เพิ่มคอมเมนต์ใหม่</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_testimonial">
                <div class="admin-form-group mb-4">
                    <label for="add-testimonial-quote" class="block text-gray-700 dark:text-gray-300 mb-1">คำพูด (Quote):</label>
                    <input type="text" id="add-testimonial-quote" name="quote" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-testimonial-text" class="block text-gray-700 dark:text-gray-300 mb-1">ข้อความ (Text):</label>
                    <textarea id="add-testimonial-text" name="text" class="admin-input-textarea w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-testimonial-author_name" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อผู้เขียน:</label>
                    <input type="text" id="add-testimonial-author_name" name="author_name" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-testimonial-author_location" class="block text-gray-700 dark:text-gray-300 mb-1">ที่อยู่ผู้เขียน:</label>
                    <input type="text" id="add-testimonial-author_location" name="author_location" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="add-testimonial-avatar" class="block text-gray-700 dark:text-gray-300 mb-1">รูปภาพ (Avatar, อัปโหลดหรือวาง URL):</label>
                    <div class="flex items-center gap-2">
                        <input type="file" id="add-testimonial-avatar" name="avatar" accept="image/*" class="admin-input-file w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500 dark:text-gray-400">หรือ</span>
                        <input type="url" id="add-testimonial-avatar_url" name="avatar_url" placeholder="วาง URL รูปภาพ" class="admin-input-url w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-submit bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">เพิ่ม</button>
                    <button type="button" onclick="hideAddTestimonialModal()" class="admin-button-cancel bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Testimonial Modal -->
    <div id="edit-testimonial-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">แก้ไขคอมเมนต์</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_testimonial">
                <input type="hidden" name="id" id="edit-testimonial-id">
                <div class="admin-form-group mb-4">
                    <label for="edit-testimonial-quote" class="block text-gray-700 dark:text-gray-300 mb-1">คำพูด (Quote):</label>
                    <input type="text" id="edit-testimonial-quote" name="quote" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-testimonial-text" class="block text-gray-700 dark:text-gray-300 mb-1">ข้อความ (Text):</label>
                    <textarea id="edit-testimonial-text" name="text" class="admin-input-textarea w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-testimonial-author_name" class="block text-gray-700 dark:text-gray-300 mb-1">ชื่อผู้เขียน:</label>
                    <input type="text" id="edit-testimonial-author_name" name="author_name" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-testimonial-author_location" class="block text-gray-700 dark:text-gray-300 mb-1">ที่อยู่ผู้เขียน:</label>
                    <input type="text" id="edit-testimonial-author_location" name="author_location" class="admin-input-text w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="admin-form-group mb-4">
                    <label for="edit-testimonial-avatar" class="block text-gray-700 dark:text-gray-300 mb-1">รูปภาพ (Avatar, อัปโหลดหรือวาง URL):</label>
                    <div class="flex items-center gap-2">
                        <input type="file" id="edit-testimonial-avatar" name="avatar" accept="image/*" class="admin-input-file w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500 dark:text-gray-400">หรือ</span>
                        <input type="url" id="edit-testimonial-avatar_url" name="avatar_url" placeholder="วาง URL รูปภาพ" class="admin-input-url w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-submit bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors duration-200 flex-1">บันทึก</button>
                    <button type="button" onclick="hideEditTestimonialModal()" class="admin-button-cancel bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Testimonial Modal -->
    <div id="delete-testimonial-modal" class="admin-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="admin-modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="admin-modal-title text-xl font-medium text-gray-700 dark:text-gray-200 mb-4">ยืนยันการลบคอมเมนต์</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">คุณแน่ใจหรือไม่ว่าต้องการลบคอมเมนต์นี้?</p>
            <form method="GET" action="">
                <input type="hidden" name="page" value="home">
                <input type="hidden" name="action" value="delete_testimonial">
                <input type="hidden" name="id" id="delete-testimonial-id">
                <div class="admin-modal-actions flex gap-2">
                    <button type="submit" class="admin-button-delete bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition-colors duration-200 flex-1">ลบ</button>
                    <button type="button" onclick="hideDeleteTestimonialModal()" class="admin-button-cancel bg-gray-500 text-white p-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 flex-1">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
// Logo Modals
function showAddLogoModal() {
    document.getElementById('add-logo-modal').classList.remove('hidden');
}

function hideAddLogoModal() {
    document.getElementById('add-logo-modal').classList.add('hidden');
}

function showEditLogoModal(id, image_url, alt_text) {
    document.getElementById('edit-logo-id').value = id;
    document.getElementById('edit-logo-image_url').value = image_url;
    document.getElementById('edit-logo-alt_text').value = alt_text;
    document.getElementById('edit-logo-modal').classList.remove('hidden');
}

function hideEditLogoModal() {
    document.getElementById('edit-logo-modal').classList.add('hidden');
}

function showDeleteLogoModal(id) {
    document.getElementById('delete-logo-id').value = id;
    document.getElementById('delete-logo-modal').classList.remove('hidden');
}

function hideDeleteLogoModal() {
    document.getElementById('delete-logo-modal').classList.add('hidden');
}

// Service Modals
function showAddServiceModal() {
    document.getElementById('add-service-modal').classList.remove('hidden');
}

function hideAddServiceModal() {
    document.getElementById('add-service-modal').classList.add('hidden');
}

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

function showDeleteServiceModal(id) {
    document.getElementById('delete-service-id').value = id;
    document.getElementById('delete-service-modal').classList.remove('hidden');
}

function hideDeleteServiceModal() {
    document.getElementById('delete-service-modal').classList.add('hidden');
}

// Work Modals
function showAddWorkModal() {
    document.getElementById('add-work-modal').classList.remove('hidden');
}

function hideAddWorkModal() {
    document.getElementById('add-work-modal').classList.add('hidden');
}

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

function showDeleteWorkModal(id) {
    document.getElementById('delete-work-id').value = id;
    document.getElementById('delete-work-modal').classList.remove('hidden');
}

function hideDeleteWorkModal() {
    document.getElementById('delete-work-modal').classList.add('hidden');
}

// Testimonial Modals
function showAddTestimonialModal() {
    document.getElementById('add-testimonial-modal').classList.remove('hidden');
}

function hideAddTestimonialModal() {
    document.getElementById('add-testimonial-modal').classList.add('hidden');
}

function showEditTestimonialModal(id, quote, text, author_name, author_location, avatar_url) {
    document.getElementById('edit-testimonial-id').value = id;
    document.getElementById('edit-testimonial-quote').value = quote;
    document.getElementById('edit-testimonial-text').value = text;
    document.getElementById('edit-testimonial-author_name').value = author_name;
    document.getElementById('edit-testimonial-author_location').value = author_location;
    document.getElementById('edit-testimonial-avatar_url').value = avatar_url;
    document.getElementById('edit-testimonial-modal').classList.remove('hidden');
}

function hideEditTestimonialModal() {
    document.getElementById('edit-testimonial-modal').classList.add('hidden');
}

function showDeleteTestimonialModal(id) {
    document.getElementById('delete-testimonial-id').value = id;
    document.getElementById('delete-testimonial-modal').classList.remove('hidden');
}

function hideDeleteTestimonialModal() {
    document.getElementById('delete-testimonial-modal').classList.add('hidden');
}

// Image Error Handling and Form Submission
document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('img[data-placeholder]');
    images.forEach(img => {
        img.onerror = function() {
            this.src = this.getAttribute('data-placeholder');
        };
    });

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', () => {
            document.getElementById('admin-loading-overlay').classList.remove('hidden');
        });
    });
});
</script>

<?php include 'partials/footer.php'; ?>