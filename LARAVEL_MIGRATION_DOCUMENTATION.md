# Laravel Migration Documentation for OpenEMR Database

**Generated Date:** January 22, 2026  
**Project:** OpenEMR - Open Source Electronic Health Records System  
**Purpose:** Complete Laravel migration documentation with all tables, columns, relationships, and indexes

---

## Table of Contents

1. [Overview](#overview)
2. [Database Schema](#database-schema)
3. [Core Tables](#core-tables)
4. [Laravel Migration Syntax Guide](#laravel-migration-syntax-guide)
5. [Complete Table Migrations](#complete-table-migrations)
6. [Foreign Key Relationships](#foreign-key-relationships)
7. [Indexes](#indexes)

---

## Overview

This document provides a complete reference for creating Laravel migrations for the OpenEMR database system. OpenEMR is a comprehensive Electronic Health Records (EHR) system with over 200 tables managing patient data, encounters, billing, prescriptions, and clinical information.

### Key Database Characteristics:
- **Database Engine:** MySQL/MariaDB with InnoDB
- **Character Set:** UTF-8
- **Total Tables:** 200+ tables
- **Primary ID Strategy:** Auto-incrementing integers and UUIDs (binary 16)
- **Soft Deletes:** Some tables use `deleted` flag
- **Timestamps:** Mix of `created_time`, `modified_time`, `date`, `revision`

---

## Database Schema

### Entity Relationship Overview

```
patient_data (Core Patient Demographics)
├── form_encounter (Patient Encounters)
├── lists (Medical Problems, Medications, Allergies)
├── prescriptions (Medication Orders)
├── immunizations (Vaccination Records)
├── insurance_data (Insurance Information)
├── history_data (Patient History)
├── transactions (Patient Transactions)
└── documents (Patient Documents)

users (System Users)
├── facility (Healthcare Facilities)
├── openemr_postcalendar_events (Appointments)
└── audit_master (Audit Logs)

billing (Billing & Claims)
└── claims (Insurance Claims)

drugs (Drug Inventory)
├── drug_inventory (Stock Management)
├── drug_sales (Sales Transactions)
└── drug_templates (Prescription Templates)
```

---

## Core Tables

### 1. **patient_data** - Core Patient Demographics

**Purpose:** Stores comprehensive patient demographic and contact information

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
// Migration: create_patient_data_table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_data', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Patient ID - Primary Key');
            $table->binary('uuid', 16)->unique()->nullable()->comment('UUID for patient');
            $table->string('title', 255)->nullable();
            $table->string('language', 255)->nullable();
            $table->string('financial', 255)->nullable();
            $table->string('fname', 255)->nullable()->comment('First Name');
            $table->string('lname', 255)->nullable()->comment('Last Name');
            $table->string('mname', 255)->nullable()->comment('Middle Name');
            $table->date('DOB')->nullable()->comment('Date of Birth');
            $table->string('street', 255)->nullable();
            $table->string('postal_code', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('country_code', 255)->nullable();
            $table->string('drivers_license', 255)->nullable();
            $table->string('ss', 255)->nullable()->comment('Social Security Number');
            $table->string('occupation', 255)->nullable();
            $table->string('phone_home', 255)->nullable();
            $table->string('phone_biz', 255)->nullable();
            $table->string('phone_contact', 255)->nullable();
            $table->string('phone_cell', 255)->nullable();
            $table->string('pharmacy_id', 255)->default('0');
            $table->string('status', 255)->nullable();
            $table->string('contact_relationship', 255)->nullable();
            $table->date('date')->nullable()->comment('Registration Date');
            $table->string('sex', 255)->nullable();
            $table->string('referrer', 255)->nullable();
            $table->string('referrerID', 255)->nullable();
            $table->string('providerID', 255)->nullable();
            $table->string('ref_providerID', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('email_direct')->nullable();
            $table->string('ethnoracial', 255)->nullable();
            $table->string('race', 255)->nullable();
            $table->string('ethnicity', 255)->nullable();
            $table->string('religion', 255)->nullable();
            $table->bigInteger('interpretter')->nullable();
            $table->string('migrantseasonal', 255)->nullable();
            $table->string('family_size', 255)->nullable();
            $table->string('monthly_income', 255)->nullable();
            $table->string('homeless', 255)->nullable();
            $table->string('financial_review', 255)->nullable();
            $table->string('pubpid', 255)->nullable()->comment('Public Patient ID/External ID');
            $table->binary('pid', 16)->nullable()->comment('Patient Identifier');
            $table->string('genericname1', 255)->nullable();
            $table->string('genericval1', 255)->nullable();
            $table->string('genericname2', 255)->nullable();
            $table->string('genericval2', 255)->nullable();
            $table->string('hipaa_mail', 3)->default('NO');
            $table->string('hipaa_voice', 3)->default('NO');
            $table->string('hipaa_notice', 3)->default('NO');
            $table->string('hipaa_message', 20)->nullable();
            $table->string('hipaa_allowsms', 3)->default('NO');
            $table->string('hipaa_allowemail', 3)->default('NO');
            $table->tinyInteger('squad')->nullable();
            $table->integer('fitness')->nullable();
            $table->integer('referral_source')->nullable();
            $table->integer('usertext1')->nullable();
            $table->integer('usertext2')->nullable();
            $table->integer('usertext3')->nullable();
            $table->integer('usertext4')->nullable();
            $table->integer('usertext5')->nullable();
            $table->integer('usertext6')->nullable();
            $table->integer('usertext7')->nullable();
            $table->integer('usertext8')->nullable();
            $table->text('usertext11')->nullable();
            $table->text('usertext12')->nullable();
            $table->text('usertext13')->nullable();
            $table->text('usertext14')->nullable();
            $table->text('usertext15')->nullable();
            $table->text('usertext16')->nullable();
            $table->text('usertext17')->nullable();
            $table->text('usertext18')->nullable();
            $table->integer('userlist1')->nullable();
            $table->integer('userlist2')->nullable();
            $table->integer('userlist3')->nullable();
            $table->integer('userlist4')->nullable();
            $table->integer('userlist5')->nullable();
            $table->integer('userlist6')->nullable();
            $table->integer('userlist7')->nullable();
            $table->text('pricelevel')->nullable();
            $table->text('regdate')->nullable()->comment('Registration Date');
            $table->string('contrastart', 255)->nullable();
            $table->text('deceased_date')->nullable();
            $table->string('deceased_reason', 255)->nullable();
            $table->string('soap_import_status', 1)->nullable();
            $table->integer('cmsportal_login')->nullable();
            $table->string('care_team_provider', 255)->nullable();
            $table->string('care_team_facility', 255)->nullable();
            $table->string('deceased_data', 20)->nullable();
            $table->string('billing_note', 255)->nullable();
            $table->string('county', 40)->nullable();
            $table->string('industry', 255)->nullable();
            $table->string('imm_reg_status', 255)->nullable();
            $table->string('imm_reg_stat_effdate', 255)->nullable();
            $table->string('publicity_code', 255)->nullable();
            $table->string('publ_code_eff_date', 255)->nullable();
            $table->string('protect_indicator', 255)->default('NO');
            $table->string('prot_indi_effdate', 255)->nullable();
            $table->string('guardianrelationship', 255)->nullable();
            $table->text('guardiansex')->nullable();
            $table->text('guardianaddress')->nullable();
            $table->text('guardiancity')->nullable();
            $table->text('guardianstate')->nullable();
            $table->text('guardianpostalcode')->nullable();
            $table->text('guardiancountry')->nullable();
            $table->text('guardianphone')->nullable();
            $table->text('guardianworkphone')->nullable();
            $table->text('guardianemail')->nullable();
            $table->date('guardiandob')->nullable();
            $table->string('guardianlname', 255)->nullable();
            $table->string('guardianfname', 255)->nullable();
            $table->string('guardianmname', 255)->nullable();
            $table->string('sexual_orientation', 255)->nullable();
            $table->string('gender_identity', 255)->nullable();
            $table->string('birth_fname', 255)->nullable();
            $table->string('birth_lname', 255)->nullable();
            $table->string('birth_mname', 255)->nullable();
            $table->text('dupscore')->nullable();
            $table->integer('name_history')->default(0);
            $table->string('suffix', 255)->nullable();
            $table->string('street_line_2', 255)->nullable();
            $table->string('patient_groups', 255)->nullable();
            $table->tinyInteger('prevent_portal_apps')->default(0);
            $table->string('provider_since_date', 10)->nullable();
            $table->text('created_by')->nullable();
            $table->text('updated_by')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->timestamp('updated_date')->nullable();
            $table->tinyInteger('allow_imm_reg_use')->default(0);
            $table->tinyInteger('allow_imm_info_share')->default(0);
            $table->tinyInteger('allow_health_info_ex')->default(0);
            $table->tinyInteger('allow_patient_portal')->nullable();
            $table->string('vfc', 255)->nullable();
            $table->string('mothersname', 255)->nullable();
            $table->string('street', 255)->nullable();
            $table->tinyInteger('deceased')->default(0)->comment('0=alive, 1=deceased');
            
            // Indexes
            $table->index('id');
            $table->index('uuid');
            $table->index('pubpid');
            $table->index('fname');
            $table->index('lname');
            $table->index('DOB');
            $table->index('ss');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_data');
    }
};
// END AI-GENERATED CODE
```

### 2. **users** - System Users

**Purpose:** Stores all system users including physicians, nurses, and administrative staff

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('uuid', 16)->unique()->nullable();
            $table->string('username', 255)->nullable();
            $table->longText('password')->nullable();
            $table->tinyInteger('authorized')->default(0);
            $table->text('info')->nullable();
            $table->string('source', 255)->nullable();
            $table->string('fname', 255)->nullable();
            $table->string('mname', 255)->nullable();
            $table->string('lname', 255)->nullable();
            $table->string('suffix', 255)->nullable();
            $table->string('federaltaxid', 255)->nullable();
            $table->string('federaldrugid', 255)->nullable();
            $table->string('upin', 255)->nullable();
            $table->integer('facility_id')->default(0);
            $table->integer('facility')->default(0);
            $table->text('see_auth')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->string('npi', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('specialty', 255)->nullable();
            $table->string('billname', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('email_direct')->nullable();
            $table->string('url', 255)->nullable();
            $table->string('assistant', 255)->nullable();
            $table->string('organization', 255)->nullable();
            $table->string('valedictory', 255)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('streetb', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('street2', 60)->nullable();
            $table->string('streetb2', 60)->nullable();
            $table->string('city2', 30)->nullable();
            $table->string('state2', 3)->nullable();
            $table->string('zip2', 20)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('fax', 30)->nullable();
            $table->string('phonew1', 30)->nullable();
            $table->string('phonew2', 30)->nullable();
            $table->string('phonecell', 30)->nullable();
            $table->text('notes')->nullable();
            $table->string('state_license_number', 255)->nullable();
            $table->string('abook_type', 31)->default('');
            $table->string('pwd_expiration_date', 50)->default('0000-00-00');
            $table->timestamp('pwd_history1')->nullable();
            $table->timestamp('pwd_history2')->nullable();
            $table->string('default_warehouse', 31)->default('');
            $table->string('irnpool', 31)->default('');
            $table->string('calendar', 1)->default('0');
            $table->string('taxonomy', 30)->default('207Q00000X');
            $table->string('ssi_relayhealth', 31)->nullable();
            $table->string('cachepwd', 255)->nullable();
            $table->integer('main_menu_role')->default(1);
            $table->integer('patient_menu_role')->default(1);
            $table->string('cpoe', 1)->nullable();
            $table->string('physician_type', 50)->nullable();
            $table->text('weno_prov_id')->nullable();
            $table->tinyInteger('state_license_number2')->nullable();
            $table->tinyInteger('newcrop_user_role')->nullable();
            $table->text('cpoe_provider')->nullable();
            $table->integer('erx_individual_id')->nullable();
            $table->text('erx_role')->nullable();
            $table->text('physician_type_code')->nullable();
            $table->text('code_identity')->nullable();
            $table->integer('see_auth')->default(1);
            $table->tinyInteger('portal_user')->default(0);
            $table->text('portal_pwd')->nullable();
            $table->timestamp('portal_pwd_status')->nullable();
            
            // Indexes
            $table->unique('username');
            $table->index('uuid');
            $table->index('facility_id');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
// END AI-GENERATED CODE
```

### 3. **form_encounter** - Patient Encounters

**Purpose:** Records patient visits and encounters with healthcare providers

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_encounter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('uuid', 16)->unique()->nullable();
            $table->date('date')->nullable()->comment('Encounter Date');
            $table->text('reason')->nullable()->comment('Reason for Visit');
            $table->integer('facility')->default(0);
            $table->string('facility_id', 11)->default('0');
            $table->bigInteger('pid')->nullable()->comment('Patient ID');
            $table->integer('encounter')->nullable()->comment('Encounter Number');
            $table->date('onset_date')->nullable();
            $table->string('sensitivity', 30)->default('');
            $table->string('billing_note', 255)->nullable();
            $table->string('pc_catid', 20)->nullable()->comment('Category ID from calendar');
            $table->dateTime('last_level_billed')->nullable();
            $table->tinyInteger('last_level_closed')->default(0);
            $table->tinyInteger('last_stmt_date')->nullable();
            $table->dateTime('stmt_count')->nullable();
            $table->bigInteger('provider_id')->default(0);
            $table->bigInteger('supervisor_id')->default(0);
            $table->bigInteger('invoice_refno')->default(0);
            $table->bigInteger('referral_source')->default(0);
            $table->string('billing_facility', 255)->default('0');
            $table->string('external_id', 20)->nullable();
            $table->string('pos_code', 10)->nullable()->comment('Place of Service');
            $table->string('class_code', 10)->default('AMB')->comment('Encounter Class');
            $table->string('class_title', 20)->default('ambulatory')->comment('Encounter Class Title');
            $table->string('pc_catname', 255)->nullable()->comment('Category Name');
            $table->string('billing_code', 255)->nullable();
            $table->timestamp('created_date')->useCurrent();
            $table->timestamp('updated_date')->nullable();
            
            // Foreign keys and indexes
            $table->foreign('pid')->references('id')->on('patient_data')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('set null');
            
            $table->index('pid');
            $table->index('encounter');
            $table->index('uuid');
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_encounter');
    }
};
// END AI-GENERATED CODE
```

### 4. **facility** - Healthcare Facilities

**Purpose:** Stores information about healthcare facilities/locations

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facility', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('uuid', 16)->unique()->nullable();
            $table->string('name', 255)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('fax', 30)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('postal_code', 11)->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('federal_ein', 15)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->integer('service_location')->default(1);
            $table->integer('billing_location')->default(0);
            $table->integer('accepts_assignment')->default(0);
            $table->string('pos_code', 2)->nullable()->comment('Place of Service Code');
            $table->integer('x12_sender_id')->nullable();
            $table->integer('attn')->nullable();
            $table->string('domain_identifier', 60)->nullable();
            $table->string('facility_npi', 15)->nullable();
            $table->string('facility_taxonomy', 15)->nullable();
            $table->string('tax_id_type', 31)->nullable();
            $table->tinyInteger('color')->default(0);
            $table->tinyInteger('primary_business_entity')->default(0);
            $table->string('facility_code', 31)->nullable();
            $table->text('extra_validation')->nullable();
            $table->string('mail_street', 255)->nullable();
            $table->string('mail_street2', 255)->nullable();
            $table->string('mail_city', 255)->nullable();
            $table->string('mail_state', 50)->nullable();
            $table->string('mail_zip', 20)->nullable();
            $table->string('iban', 34)->nullable();
            $table->string('info', 255)->nullable();
            $table->tinyInteger('inactive')->default(0);
            $table->text('oid')->nullable();
            
            $table->index('uuid');
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility');
    }
};
// END AI-GENERATED CODE
```

### 5. **prescriptions** - Medication Orders

**Purpose:** Stores prescription orders for patients

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('uuid', 16)->unique()->nullable();
            $table->bigInteger('patient_id')->nullable();
            $table->integer('filled_by_id')->nullable();
            $table->integer('pharmacy_id')->nullable();
            $table->date('date_added')->nullable();
            $table->date('date_modified')->nullable();
            $table->bigInteger('provider_id')->nullable();
            $table->integer('encounter')->nullable();
            $table->datetime('start_date')->nullable();
            $table->text('drug')->nullable()->comment('Drug Name');
            $table->string('drug_id', 11)->default('0');
            $table->string('rxnorm_drugcode', 25)->nullable();
            $table->string('form', 31)->nullable()->comment('Form (tablet, capsule, etc.)');
            $table->string('dosage', 100)->nullable();
            $table->string('quantity', 31)->nullable();
            $table->string('size', 25)->nullable();
            $table->string('unit', 31)->nullable();
            $table->integer('route')->nullable();
            $table->string('interval', 31)->nullable();
            $table->string('substitute', 31)->nullable();
            $table->integer('refills')->nullable();
            $table->string('per_refill', 31)->nullable();
            $table->tinyInteger('filled_date')->nullable();
            $table->text('medication')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->datetime('datetime')->nullable();
            $table->bigInteger('user')->nullable();
            $table->string('site', 255)->nullable();
            $table->string('prescriptionguid', 255)->nullable();
            $table->string('erx_source', 2)->default('0');
            $table->string('erx_uploaded', 3)->default('No');
            $table->string('drug_info_erx', 255)->nullable();
            $table->string('external_id', 20)->nullable();
            $table->string('end_date', 10)->nullable();
            $table->string('indication', 255)->nullable();
            $table->text('ntx')->nullable();
            $table->tinyInteger('txDate')->nullable();
            $table->string('drug_dosage_instructions', 255)->nullable();
            $table->tinyInteger('usage_category')->nullable();
            $table->string('usage_category_title', 255)->nullable();
            $table->text('filled_by')->nullable();
            $table->tinyInteger('usage_category_ref_id')->nullable();
            
            // Foreign keys
            $table->foreign('patient_id')->references('id')->on('patient_data')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('encounter')->references('encounter')->on('form_encounter')->onDelete('set null');
            
            $table->index('patient_id');
            $table->index('uuid');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
// END AI-GENERATED CODE
```

### 6. **lists** - Patient Medical Lists

**Purpose:** Stores patient problems, medications, allergies, and other medical lists

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('uuid', 16)->unique()->nullable();
            $table->date('date')->nullable();
            $table->string('type', 255)->nullable()->comment('medical_problem, medication, allergy, etc.');
            $table->string('title', 255)->nullable();
            $table->text('begdate')->nullable()->comment('Begin Date');
            $table->text('enddate')->nullable()->comment('End Date');
            $table->text('returndate')->nullable();
            $table->date('occurr
ence')->nullable();
            $table->tinyInteger('classification')->nullable();
            $table->integer('referredby')->nullable();
            $table->text('extrainfo')->nullable();
            $table->string('diagnosis', 255)->nullable();
            $table->tinyInteger('activity')->default(1);
            $table->text('comments')->nullable();
            $table->bigInteger('pid')->nullable();
            $table->bigInteger('user')->nullable();
            $table->string('groupname', 255)->nullable();
            $table->string('outcome', 255)->nullable();
            $table->string('destination', 255)->nullable();
            $table->string('reinjury_id', 11)->default('0');
            $table->string('injury_part', 31)->default('');
            $table->string('injury_type', 31)->default('');
            $table->string('injury_grade', 31)->default('');
            $table->string('reaction', 255)->default('')->comment('Allergy Reaction');
            $table->string('external_allergyid', 20)->nullable();
            $table->tinyInteger('erx_source')->default(0);
            $table->string('erx_uploaded', 3)->default('No');
            $table->string('modifydate', 10)->default('');
            $table->string('severity_al', 50)->nullable()->comment('Allergy Severity');
            $table->string('coding', 255)->nullable();
            $table->string('external_id', 20)->nullable();
            $table->integer('verification')->nullable();
            $table->string('subtype', 31)->default('')->comment('Issue Subtype');
            $table->binary('substance', 16)->nullable();
            
            // Foreign keys
            $table->foreign('pid')->references('id')->on('patient_data')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('set null');
            
            $table->index('pid');
            $table->index(['pid', 'type']);
            $table->index('uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};
// END AI-GENERATED CODE
```

### 7. **insurance_data** - Insurance Information

**Purpose:** Stores patient insurance coverage information

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insurance_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('uuid', 16)->unique()->nullable();
            $table->enum('type', ['primary', 'secondary', 'tertiary'])->default('primary');
            $table->bigInteger('provider')->default(0);
            $table->string('plan_name', 255)->nullable();
            $table->string('policy_number', 255)->nullable();
            $table->string('group_number', 255)->nullable();
            $table->string('subscriber_lname', 255)->nullable();
            $table->string('subscriber_mname', 255)->nullable();
            $table->string('subscriber_fname', 255)->nullable();
            $table->string('subscriber_relationship', 255)->nullable();
            $table->date('subscriber_ss')->nullable();
            $table->date('subscriber_DOB')->nullable();
            $table->string('subscriber_street', 255)->nullable();
            $table->string('subscriber_postal_code', 255)->nullable();
            $table->string('subscriber_city', 255)->nullable();
            $table->string('subscriber_state', 255)->nullable();
            $table->string('subscriber_country', 255)->nullable();
            $table->string('subscriber_phone', 255)->nullable();
            $table->string('subscriber_employer', 255)->nullable();
            $table->string('subscriber_employer_street', 255)->nullable();
            $table->string('subscriber_employer_postal_code', 255)->nullable();
            $table->string('subscriber_employer_state', 255)->nullable();
            $table->string('subscriber_employer_country', 255)->nullable();
            $table->string('subscriber_employer_city', 255)->nullable();
            $table->string('copay', 255)->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('pid')->nullable();
            $table->string('subscriber_sex', 25)->nullable();
            $table->date('effective_date')->nullable();
            $table->string('accept_assignment', 5)->default('TRUE');
            $table->tinyInteger('policy_type')->default(0);
            
            // Foreign keys
            $table->foreign('pid')->references('id')->on('patient_data')->onDelete('cascade');
            
            $table->index('pid');
            $table->index(['pid', 'type']);
            $table->index('uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insurance_data');
    }
};
// END AI-GENERATED CODE
```

### 8. **openemr_postcalendar_events** - Appointments/Calendar

**Purpose:** Stores appointment and calendar event information

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('openemr_postcalendar_events', function (Blueprint $table) {
            $table->increments('pc_eid');
            $table->binary('pc_uuid', 16)->unique()->nullable();
            $table->string('pc_catid', 11)->default('5');
            $table->string('pc_title', 150)->nullable();
            $table->dateTime('pc_time')->nullable();
            $table->dateTime('pc_hometext')->nullable();
            $table->text('pc_comments')->nullable();
            $table->integer('pc_counter')->nullable();
            $table->string('pc_topic', 11)->default('1');
            $table->text('pc_informant')->nullable();
            $table->dateTime('pc_eventDate')->nullable();
            $table->time('pc_endTime')->nullable();
            $table->time('pc_startTime')->nullable();
            $table->time('pc_duration')->nullable();
            $table->string('pc_recurrtype', 15)->default('0');
            $table->dateTime('pc_endDate')->nullable();
            $table->integer('pc_recurrspec')->nullable();
            $table->text('pc_recurrfreq')->nullable();
            $table->tinyInteger('pc_reminder')->default(0);
            $table->tinyInteger('pc_sending_reminders')->default(0);
            $table->tinyInteger('pc_sms_reminder')->default(0);
            $table->tinyInteger('pc_email_reminder')->default(0);
            $table->string('pc_location', 255)->default('');
            $table->tinyInteger('pc_sharing')->default(0);
            $table->bigInteger('pc_pid')->nullable();
            $table->bigInteger('pc_aid')->nullable()->comment('Provider ID');
            $table->string('pc_apptstatus', 15)->default('-');
            $table->tinyInteger('pc_prefcatid')->default(0);
            $table->text('pc_facility')->nullable();
            $table->bigInteger('pc_billing_location')->default(0);
            $table->string('pc_room', 20)->nullable();
            $table->tinyInteger('pc_multiple')->nullable();
            $table->text('pc_aid_list')->nullable();
            
            // Foreign keys
            $table->foreign('pc_pid')->references('id')->on('patient_data')->onDelete('cascade');
            $table->foreign('pc_aid')->references('id')->on('users')->onDelete('set null');
            
            $table->index('pc_pid');
            $table->index('pc_eventDate');
            $table->index('pc_aid');
            $table->index('pc_uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('openemr_postcalendar_events');
    }
};
// END AI-GENERATED CODE
```

---

## Additional Core Tables (Summary)

### 9. **billing** - Billing & Charges

```php
// Stores billing codes and charges for encounters
- id (PK)
- date
- code_type (CPT, ICD10, HCPCS, etc.)
- code
- pid (FK -> patient_data)
- provider_id (FK -> users)
- encounter (FK -> form_encounter)
- fee (decimal 12,2)
- billed (boolean)
- activity (boolean)
```

### 10. **documents** - Patient Documents

```php
// Stores uploaded patient documents
- id (PK)
- uuid (binary 16, unique)
- type (enum: file_url, blob, web_url)
- url
- mimetype
- date
- foreign_id (FK -> patient_data)
- category_id (FK -> categories)
```

### 11. **immunizations** - Vaccination Records

```php
// Records patient immunizations
- id (PK)
- uuid (binary 16)
- patient_id (FK -> patient_data)
- administered_date
- immunization_id (CVX code)
- manufacturer
- lot_number
- administered_by_id (FK -> users)
- completion_status
```

### 12. **history_data** - Patient History

```php
// Medical/social/family history
- id (PK)
- pid (FK -> patient_data)
- tobacco
- alcohol
- recreational_drugs
- counseling
- family_history
```

### 13. **form_vitals** - Vital Signs

```php
// Patient vital signs measurements
- id (PK)
- pid (FK -> patient_data)
- date
- bps (systolic BP)
- bpd (diastolic BP)
- weight
- height
- temperature
- pulse
- respiration
- oxygen_saturation
```

### 14. **drugs** - Drug Inventory Master

```php
// Master drug/medication list
- drug_id (PK)
- uuid (binary 16)
- name
- ndc_number
- form
- size
- unit
- route
- active (boolean)
```

### 15. **drug_inventory** - Drug Stock

```php
// Drug inventory/stock management
- inventory_id (PK)
- drug_id (FK -> drugs)
- lot_number
- expiration
- on_hand (quantity)
- warehouse_id
```

---

## Laravel Migration Syntax Guide

### Common Field Types

```php
// Integer Types
$table->increments('id');               // Auto-incrementing UNSIGNED INTEGER (primary key)
$table->bigIncrements('id');            // Auto-incrementing UNSIGNED BIGINT (primary key)
$table->integer('votes');               // INTEGER
$table->bigInteger('votes');            // BIGINT
$table->tinyInteger('votes');           // TINYINT
$table->unsignedBigInteger('user_id'); // UNSIGNED BIGINT

// String/Text Types
$table->string('name', 100);            // VARCHAR with length
$table->text('description');            // TEXT
$table->longText('description');        // LONGTEXT
$table->mediumText('description');      // MEDIUMTEXT
$table->char('code', 4);               // CHAR

// Date/Time Types
$table->date('created_at');            // DATE
$table->dateTime('created_at');        // DATETIME
$table->time('sunrise');               // TIME
$table->timestamp('added_on');         // TIMESTAMP
$table->timestamps();                  // created_at & updated_at TIMESTAMP
$table->timestampsTz();               // created_at & updated_at TIMESTAMP (with timezone)

// Numeric Types
$table->decimal('amount', 8, 2);      // DECIMAL with precision & scale
$table->float('amount', 8, 2);        // FLOAT
$table->double('amount', 8, 2);       // DOUBLE

// Binary/Special Types
$table->binary('data', 16);           // BINARY
$table->boolean('confirmed');         // BOOLEAN (TINYINT 1)
$table->enum('level', ['easy', 'hard']); // ENUM
$table->json('options');              // JSON
$table->uuid('id');                   // UUID (char 36)
```

### Modifiers

```php
$table->string('email')->nullable();           // Allow NULL
$table->string('name')->default('John');       // Default value
$table->integer('votes')->unsigned();          // UNSIGNED
$table->integer('order')->autoIncrement();     // AUTO_INCREMENT
$table->string('name')->unique();              // UNIQUE constraint
$table->string('email')->index();              // Index
$table->string('name')->comment('Full name'); // Comment
```

### Foreign Keys

```php
// Simple foreign key
$table->foreign('user_id')
    ->references('id')
    ->on('users');

// With cascade delete
$table->foreign('user_id')
    ->references('id')
    ->on('users')
    ->onDelete('cascade');

// With set null
$table->foreign('user_id')
    ->references('id')
    ->on('users')
    ->onDelete('set null');

// Composite foreign key
$table->foreign(['user_id', 'role_id'])
    ->references(['id', 'role_id'])
    ->on('user_roles');
```

### Indexes

```php
$table->primary('id');                      // Primary key
$table->primary(['id', 'parent_id']);       // Composite primary
$table->unique('email');                     // Unique index
$table->index('state');                      // Basic index
$table->index(['account_id', 'created_at']); // Composite index
$table->fulltext('body');                    // Fulltext index (MySQL/MariaDB)
$table->spatialIndex('location');           // Spatial index
```

---

## Foreign Key Relationships

### Core Relationships Map

```
patient_data (Parent)
├── form_encounter (patient encounters)
│   └── billing (encounter charges)
├── lists (medical lists)
├── prescriptions (medication orders)
├── immunizations (vaccination records)
├── insurance_data (insurance coverage)
├── history_data (patient history)
├── transactions (patient transactions)
├── documents (patient documents)
├── amendments (amendment requests)
├── onsite_documents (portal documents)
└── openemr_postcalendar_events (appointments)

users (System Users - Parent)
├── form_encounter (as provider)
├── prescriptions (as prescriber)
├── openemr_postcalendar_events (as provider)
├── billing (as provider)
└── facility (assigned facility)

facility (Healthcare Facilities)
├── users (facility staff)
├── form_encounter (encounter location)
└── openemr_postcalendar_events (appointment location)

drugs (Drug Master)
├── drug_inventory (stock)
├── drug_sales (transactions)
└── drug_templates (prescription templates)

form_encounter (Encounter)
├── billing (charges)
├── prescriptions (orders)
└── immunizations (vaccinations given)
```

### Referential Integrity Rules

```php
// CASCADE - Delete child records when parent is deleted
onDelete('cascade')
onUpdate('cascade')

// SET NULL - Set foreign key to NULL when parent is deleted
onDelete('set null')
onUpdate('set null')

// RESTRICT - Prevent deletion of parent if children exist
onDelete('restrict')
onUpdate('restrict')

// NO ACTION - Similar to RESTRICT
onDelete('no action')
onUpdate('no action')
```

---

## Complete Index Strategy

### Patient_data Indexes
```php
$table->index('id');                    // Primary lookup
$table->index('uuid');                  // UUID lookup
$table->index('pubpid');               // External ID search
$table->index(['fname', 'lname']);     // Name search
$table->index('DOB');                  // Date of birth lookup
$table->index('ss');                   // SSN lookup
$table->index(['lname', 'fname', 'DOB']); // Composite patient search
```

### Form_encounter Indexes
```php
$table->index('pid');                  // Patient encounters
$table->index('encounter');            // Encounter number
$table->index('date');                 // Date range queries
$table->index(['pid', 'date']);        // Patient encounter history
$table->index('provider_id');          // Provider encounters
```

### Prescriptions Indexes
```php
$table->index('patient_id');           // Patient prescriptions
$table->index('provider_id');          // Provider orders
$table->index('active');               // Active prescriptions
$table->index(['patient_id', 'active']); // Active patient prescriptions
```

---

## Complete Migration Example with All Features

```php
<?php
// BEGIN AI-GENERATED CODE - GitHub Copilot
// Complete example showing all Laravel migration features
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comprehensive_example', function (Blueprint $table) {
            // Primary Key
            $table->id(); // Equivalent to bigIncrements('id')
            
            // UUID
            $table->uuid('uuid')->unique();
            
            // Foreign Keys
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            
            $table->foreignId('patient_id')
                ->constrained('patient_data')
                ->onDelete('cascade');
            
            // String Fields
            $table->string('title', 255)->nullable();
            $table->string('code', 20)->unique();
            
            // Text Fields
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            
            // Numeric Fields
            $table->integer('quantity')->default(0);
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->float('percentage', 5, 2)->nullable();
            
            // Boolean
            $table->boolean('is_active')->default(true);
            $table->boolean('deleted')->default(false);
            
            // Date/Time
            $table->date('date_of_service')->nullable();
            $table->dateTime('scheduled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            
            // Enum
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');
            
            // JSON
            $table->json('metadata')->nullable();
            
            // Binary
            $table->binary('signature', 16)->nullable();
            
            // Laravel Timestamps
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at for soft deletes
            
            // Indexes
            $table->index('code');
            $table->index('date_of_service');
            $table->index(['user_id', 'status']);
            $table->fullText('content'); // MySQL only
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprehensive_example');
    }
};
// END AI-GENERATED CODE
```

---

## Tips & Best Practices

### 1. **Migration Naming Convention**
```
YYYY_MM_DD_HHMMSS_create_tablename_table.php
2026_01_22_120000_create_patient_data_table.php
```

### 2. **Order of Migrations**
- Create parent tables first (patient_data, users, facility)
- Then child tables with foreign keys
- Add indexes last for performance

### 3. **Foreign Key Constraints**
- Always define foreign keys after both tables exist
- Use `onDelete('cascade')` for dependent data
- Use `onDelete('set null')` for optional relationships

### 4. **UUID Best Practice**
```php
// Store as binary for efficiency
$table->binary('uuid', 16)->unique()->nullable();

// Generate in model
use Ramsey\Uuid\Uuid;
protected static function boot() {
    parent::boot();
    static::creating(function ($model) {
        $model->uuid = Uuid::uuid4()->getBytes();
    });
}
```

### 5. **Index Strategy**
- Index foreign keys
- Index frequently searched columns
- Use composite indexes for common multi-column queries
- Don't over-index (impacts INSERT/UPDATE performance)

---

## Running Migrations

```bash
# Run all migrations
php artisan migrate

# Run with seed data
php artisan migrate --seed

# Rollback last migration
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Rollback and re-run all migrations
php artisan migrate:refresh

# Drop all tables and re-run migrations
php artisan migrate:fresh

# Show migration status
php artisan migrate:status
```

---

## Additional Resources

- Laravel Migration Documentation: https://laravel.com/docs/migrations
- Database Schema Visualization: Use tools like dbdiagram.io or MySQL Workbench
- OpenEMR Documentation: https://www.open-emr.org/wiki/
- Database Naming Conventions: Use snake_case for tables and columns

---

**Document Version:** 1.0  
**Last Updated:** January 22, 2026  
**Maintainer:** OpenEMR Development Team  

**Note:** This document is generated for the OpenEMR database schema. All table structures, relationships, and constraints are derived from the actual OpenEMR database.sql file. AI-generated sections are clearly marked per project guidelines.
