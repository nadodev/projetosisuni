<?php

namespace App\Services;

use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeGuardianMail;

class StudentRegistrationService
{
    public function register(array $data): StudentProfile
    {
        return DB::transaction(function () use ($data) {
            \Log::info('Iniciando registro do estudante', $data);
            
            // Criar usuário
            $user = User::create([
                'name' => $data['full_name'],
                'email' => $data['guardian_email'],
                'password' => Hash::make(Str::random(10)),
                'role' => 'user_student',
                'institution_id' => $data['institution_id'],
                'cpf' => $data['cpf'],
                'data_nascimento' => $data['birth_date'],
                'genero' => $data['gender'] ?? 'outro',
                'telefone' => $data['guardian_phone'],
                'cep' => $data['guardian_cep'] ?? null,
                'endereco' => $data['guardian_endereco'] ?? null,
                'bairro' => $data['guardian_bairro'] ?? null,
                'cidade' => $data['guardian_cidade'] ?? null,
                'uf' => $data['guardian_uf'] ?? null,
                'numero' => $data['guardian_numero'] ?? null,
                'complemento' => $data['guardian_complemento'] ?? null,
            ]);

            \Log::info('Usuário criado:', ['user_id' => $user->id]);

            // Criar perfil do estudante
            $studentProfileData = [
                'user_id' => $user->id,
                'institution_id' => $data['institution_id'],
                'full_name' => $data['full_name'],
                'social_name' => $data['social_name'] ?? null,
                'gender' => $data['gender'] ?? null,
                'birth_date' => $data['birth_date'],
                'cpf' => $data['cpf'],
                'school_code' => $data['school_code'] ?? null,
                'registration_number' => $data['registration_number'],
                'grade_year' => $data['grade_year'],
                'class_id' => $data['class_id'],
                'shift' => $data['shift'],
                'unit' => $data['unit'] ?? null,
                'teacher_id' => $data['teacher_id'],
                'neurodivergence_types' => $data['neurodivergence_types'],
                'has_official_diagnosis' => isset($data['has_official_diagnosis']) && $data['has_official_diagnosis'] == '1' ? true : false,
                'pedagogical_observations' => $data['pedagogical_observations'] ?? null,
                'specific_needs' => $data['specific_needs'] ?? [],
                'learning_style' => $data['learning_style'] ?? null,
                'sensitivities' => $data['sensitivities'] ?? null,
                'guardian_name' => $data['guardian_name'],
                'guardian_kinship' => $data['guardian_kinship'],
                'guardian_cpf' => $data['guardian_cpf'],
                'guardian_email' => $data['guardian_email'],
                'guardian_phone' => $data['guardian_phone'],
                'secondary_guardian_name' => $data['secondary_guardian_name'] ?? null,
                'secondary_guardian_kinship' => $data['secondary_guardian_kinship'] ?? null,
                'secondary_guardian_cpf' => $data['secondary_guardian_cpf'] ?? null,
                'secondary_guardian_email' => $data['secondary_guardian_email'] ?? null,
                'secondary_guardian_phone' => $data['secondary_guardian_phone'] ?? null,
                'guardian_panel_access' => isset($data['guardian_panel_access']) && $data['guardian_panel_access'] == '1' ? true : false,
                'external_support_name' => $data['external_support_name'] ?? null,
                'status' => 'ativo',
            ];

            \Log::info('Dados do perfil do estudante:', $studentProfileData);

            $studentProfile = StudentProfile::create($studentProfileData);

            \Log::info('Perfil do estudante criado:', ['student_profile_id' => $studentProfile->id]);

            // Enviar e-mail de boas-vindas para o responsável
            try {
                Mail::to($data['guardian_email'])->queue(new WelcomeGuardianMail($user, $studentProfile));
                \Log::info('E-mail de boas-vindas enviado para:', ['email' => $data['guardian_email']]);
            } catch (\Exception $e) {
                \Log::error('Erro ao enviar e-mail de boas-vindas:', ['error' => $e->getMessage()]);
            }

            return $studentProfile;
        });
    }
} 