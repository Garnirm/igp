<template>
    <div class="login-page">
        <div class="login-card">
            <div v-if="loginFailed" class="login-card__banner">
                Identifiants incorrects
            </div>

            <h1 class="login-card__title">Connexion</h1>

            <form @submit.prevent="submit" class="login-card__form">
                <div class="login-card__field">
                    <label for="email" class="login-card__label">Email</label>

                    <input id="email" v-model="form.email" type="email" class="login-card__input" required autofocus />
                </div>

                <div class="login-card__field">
                    <label for="password" class="login-card__label">Mot de passe</label>

                    <input id="password" v-model="form.password" type="password" class="login-card__input" required />
                </div>

                <button type="submit" class="login-card__button" :disabled="form.processing">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

defineProps({
    loginFailed: Boolean,
})

const form = useForm({
    email: '',
    password: '',
})

const submit = () => {
    form.post('/login/ops')
}
</script>

<style lang="scss" scoped>
.login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
}

.login-card {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;

    &__title {
        margin: 0 0 1.5rem;
        font-size: 1.5rem;
        text-align: center;
        color: #333;
    }

    &__form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    &__field {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    &__label {
        font-size: 0.875rem;
        color: #666;
    }

    &__input {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;

        &:focus {
            outline: none;
            border-color: #4B5563;
        }
    }

    &__banner {
        background-color: #dc2626;
        color: white;
        padding: 0.75rem 1rem;
        border-radius: 4px;
        font-size: 0.875rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    &__button {
        padding: 0.75rem;
        background-color: #4B5563;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 0.5rem;

        &:hover {
            background-color: #374151;
        }

        &:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    }
}
</style>
